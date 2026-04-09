<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquillaje;
use App\Models\Marca;

class MaquillajeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR MAQUILLAJES
    |--------------------------------------------------------------------------
    | Muestra todos los maquillajes registrados.
    | Permite buscar por nombre y filtrar por estado.
    */
    public function index(Request $request)
    {
        $search = $request->search;
        $estado = $request->estado;

        $maquillajes = Maquillaje::with('marcaRelacion')
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->when($estado !== null && $estado !== '', function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('maquillajes.index', compact('maquillajes'));
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO DE REGISTRO DE MAQUILLAJES
    |--------------------------------------------------------------------------
    | Muestra la vista para agregar un nuevo maquillaje.
    */
    public function create()
    {
        $marcas = Marca::where('estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        return view('maquillajes.create', compact('marcas'));
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR NUEVO MAQUILLAJE
    |--------------------------------------------------------------------------
    | Guarda un nuevo maquillaje en la base de datos.
    */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $rutaImagen = null;

        // Validar si se subió una imagen
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('maquillajes', 'public');
        }

        $marca = Marca::find($request->marca_id);

        // Registrar nuevo maquillaje
        Maquillaje::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'marca' => $marca ? $marca->nombre : null,
            'marca_id' => $request->marca_id,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $rutaImagen,
            'estado' => $request->estado,
        ]);

        // Redireccionar a la lista de maquillajes
        return redirect()->route('maquillajes.index')
            ->with('success', 'Maquillaje Registrado Correctamente!');
    }

    /*
    |--------------------------------------------------------------------------
    | CONSULTAR INFORMACIÓN
    |--------------------------------------------------------------------------
    | Retorna la vista con los datos del maquillaje para editar.
    */
    public function edit(Maquillaje $maquillaje)
    {
        $marcas = Marca::where('estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        // Retornar vista con los datos del maquillaje
        return view('maquillajes.edit', compact('maquillaje', 'marcas'));
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR INFORMACIÓN
    |--------------------------------------------------------------------------
    | Actualiza los datos del maquillaje.
    */
    public function update(Request $request, Maquillaje $maquillaje)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $rutaImagen = $maquillaje->imagen;

        // Validar si se subió una nueva imagen
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('maquillajes', 'public');
        }

        $marca = Marca::find($request->marca_id);

        // Realizar actualización en la BD
        $maquillaje->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'marca' => $marca ? $marca->nombre : null,
            'marca_id' => $request->marca_id,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $rutaImagen,
            'estado' => $request->estado,
        ]);

        return redirect()->route('maquillajes.index')
            ->with('success', 'Actualización Exitosa :D');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR MAQUILLAJE
    |--------------------------------------------------------------------------
    | Elimina el registro de la base de datos.
    */
    public function destroy(Maquillaje $maquillaje)
    {
        // Eliminación del registro
        $maquillaje->delete();

        // Redireccionar al listado
        return redirect()->route('maquillajes.index')
            ->with('success', 'Maquillaje Eliminado Correctamente!');
    }
}