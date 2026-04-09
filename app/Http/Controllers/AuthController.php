<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO DE REGISTRO DE USUARIOS
    |--------------------------------------------------------------------------
    | Esta vista será usada por el administrador para registrar nuevos
    | usuarios dentro del panel administrativo.
    */
    public function registerForm()
    {
        $modoAdmin = true;

        return view('auth.register', compact('modoAdmin'));
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO DE REGISTRO PÚBLICO
    |--------------------------------------------------------------------------
    | Esta vista será usada por los visitantes para registrarse
    | desde fuera del panel administrativo.
    */
    public function publicRegisterForm()
    {
        $modoAdmin = false;

        return view('auth.register', compact('modoAdmin'));
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR NUEVO USUARIO
    |--------------------------------------------------------------------------
    | El administrador puede registrar clientes o administradores.
    | Si marca el checkbox de "is_admin", se guarda como administrador.
    | Si no, se guarda como cliente.
    | Importante: aquí NO iniciamos sesión con el usuario nuevo, para no
    | sacar al admin que está trabajando.
    */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'is_admin' => auth()->user()->is_admin ? ($request->has('is_admin') ? 1 : 0) : 0,
        ]);

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Usuario Registrado Correctamente :D');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRO PÚBLICO DE CLIENTES
    |--------------------------------------------------------------------------
    | Los visitantes se registran desde fuera del panel.
    | Siempre se guardan como clientes.
    | Después del registro se redirige al login con alerta de éxito.
    */
    public function publicRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'is_admin' => 0,
        ]);

        return redirect()
            ->route('login')
            ->with('registro', 'Tu cuenta fue creada correctamente. Ahora ya puedes iniciar sesión.');
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO DE LOGIN
    |--------------------------------------------------------------------------
    | Muestra la vista de acceso para que usuarios y administradores
    | puedan iniciar sesión.
    */
    public function loginForm()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | INICIAR SESIÓN
    |--------------------------------------------------------------------------
    | Verifica credenciales.
    | - Si es admin, lo manda al panel de usuarios.
    | - Si es cliente, lo manda al home.
    */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin-dashboard')
                    ->with('success', 'Bienvenid@ de nuevo al panel administrativo.');
            }

            return redirect()->route('home')
                ->with('success', 'Inicio de sesión exitoso. Bienvenid@ a Velour Beauty.');
        }

        return back()
            ->withInput()
            ->with('error', 'Correo o contraseña incorrectos. Verifica tus credenciales o regístrate si aún no tienes cuenta.');
    }

    /*
    |--------------------------------------------------------------------------
    | CERRAR SESIÓN
    |--------------------------------------------------------------------------
    | Finaliza la sesión actual del usuario autenticado y lo manda
    | de regreso al inicio.
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Sesión cerrada correctamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | PANEL ADMINISTRATIVO - GESTIÓN DE USUARIOS
    |--------------------------------------------------------------------------
    | Esta será la vista principal del administrador.
    | También permite buscar usuarios por nombre y filtrarlos por tipo.
    */
    public function usuarios(Request $request)
    {
        $search = $request->search;
        $tipo = $request->tipo;

        $usuarios = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($tipo === 'admin', function ($query) {
                $query->where('is_admin', 1);
            })
            ->when($tipo === 'cliente', function ($query) {
                $query->where('is_admin', 0);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.dashboard', compact('usuarios'));
    }

    /**
     * CONSULTAR INFORMACIÓN
     */
    public function edit(User $usuario)
    {
        // Retornar vista con los datos del usuario
        return view('admin.edit-user', compact('usuario'));
    }

    /**
     * ACTUALIZAR INFORMACIÓN
     */
    public function update(Request $request, User $usuario)
    {
        // Realizar validaciones del campo formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'phone' => 'nullable',
            'password' => 'nullable|min:6|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        // Si se escribió contraseña, se encripta
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
            $usuario->save();
        }

        // Realizar actualización en la BD
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_admin' => auth()->user()->is_admin ? ($request->has('is_admin') ? 1 : 0) : 0,
        ]);

        return redirect()
            ->route('admin.usuarios')
            ->with('success', 'Actualización Exitosa :D');
    }

    /**
     * ELIMINAR USUARIO
     */
    public function destroy(User $usuario)
    {
        // Eliminación del registro
        $usuario->delete();

        // Redireccionar al usuario
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente!');
    }
}