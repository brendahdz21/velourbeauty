<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquillaje;
use App\Models\Marca;

use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    /**
     * MOSTRAR HOME PRINCIPAL
     */
    public function home()
    {
        $maquillajes = Maquillaje::with('marcaRelacion')
            ->where('estado', 1)
            ->orderBy('id', 'asc')
            ->get();

        $marcas = Marca::where('estado', 1)
            ->orderBy('id', 'asc')
            ->get();

        return view('site.home', compact('maquillajes', 'marcas'));
    }


    /**
     * MOSTRAR VISTA CONÓCENOS
     */
    public function conocenos()
    {
        //Retornar vista Conócenos
        return view('site.conocenos');
    }

    /**
    * MOSTRAR CATALOGO DE PRODUCTOS DESDE API
    */
    public function catalogo()
    {
        //Variable para almacenar productos de la API
        $productosApi = [];

        //Consultar marcas activas
        $marcas = Marca::where('estado', 1)
            ->orderBy('id', 'asc')
            ->get();

        try {
            //Arreglo de categorias a consultar
            $categorias = ['beauty', 'fragrances', 'skin-care'];

            //Coleccion para guardar todos los productos
            $coleccionProductos = collect();

            //Recorrer categorias y consumir API
            foreach ($categorias as $categoria) {
                $response = Http::timeout(10)
                    ->get("https://dummyjson.com/products/category/{$categoria}");

                //Validar respuesta correcta
                if ($response->successful()) {
                    $data = $response->json();

                    //Unir productos de cada categoria
                    $coleccionProductos = $coleccionProductos->merge($data['products'] ?? []);
                }
            }

            //Guardar productos obtenidos sin repetir y limitar a 12
            $productosApi = $coleccionProductos
                ->unique('id')
                ->take(12)
                ->map(function ($producto) {
                    return [
                        'id' => $producto['id'] ?? null,
                        'title' => $producto['title'] ?? 'Sin nombre',
                        'description' => $producto['description'] ?? 'Sin descripción',
                        'price' => $producto['price'] ?? 0,
                        'category' => $producto['category'] ?? 'Sin categoría',
                        'brand' => $producto['brand'] ?? 'Sin marca',
                        'thumbnail' => $producto['thumbnail'] ?? null,
                        'rating' => $producto['rating'] ?? null,
                        'stock' => $producto['stock'] ?? null,
                    ];
                })
                ->values()
                ->toArray();

        } catch (\Exception $e) {
            //Si falla la API, dejar arreglo vacío
            $productosApi = [];
        }

        //Redireccionar a la vista catalogo
        return view('site.catalogo', compact('productosApi', 'marcas'));
    }
}