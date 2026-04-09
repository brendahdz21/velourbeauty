<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR MARCAS
    |--------------------------------------------------------------------------
    | Muestra todas las marcas registradas.
    | También permite buscar por nombre y filtrar por estado.
    */
    public function index(Request $request)
    {
        $search = $request->search;
        $estado = $request->estado;

        $marcas = Marca::query()
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->when($estado !== null && $estado !== '', function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('marcas.indexmarcas', compact('marcas'));
    }

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR FORMULARIO DE REGISTRO DE MARCAS
    |--------------------------------------------------------------------------
    | Muestra la vista para agregar una nueva marca.
    */
    public function create()
    {
        return view('marcas.createmarcas');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTRAR NUEVA MARCA
    |--------------------------------------------------------------------------
    | Guarda una nueva marca en la base de datos.
    */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $rutaImagen = null;

        // Validar si se subió una imagen
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('marcas', 'public');
        }

        // Registrar nueva marca
        Marca::create([
            'nombre' => $request->nombre,
            'imagen' => $rutaImagen,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        // Redireccionar a la lista de marcas
        return redirect()->route('admin.marcas')
            ->with('success', 'Marca registrada correctamente!');
    }

    /**
     * CONSULTAR INFORMACIÓN
     */
    public function edit(Marca $marca)
    {
        // Retornar vista con los datos de la marca
        return view('marcas.editmarcas', compact('marca'));
    }

    /**
     * ACTUALIZAR INFORMACIÓN
     */
    public function update(Request $request, Marca $marca)
    {
        // Realizar validaciones del campo formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $rutaImagen = $marca->imagen;

        // Validar si se subió una nueva imagen
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('marcas', 'public');
        }

        // Realizar actualización en la BD
        $marca->update([
            'nombre' => $request->nombre,
            'imagen' => $rutaImagen,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.marcas')
            ->with('success', 'Actualización Exitosa :D');
    }

    /**
     * ELIMINAR MARCA
     */
    public function destroy(Marca $marca)
    {
        // Eliminación del registro
        $marca->delete();

        // Redireccionar a la lista de marcas
        return redirect()->route('admin.marcas')
            ->with('success', 'Marca eliminada correctamente!');
    }
}