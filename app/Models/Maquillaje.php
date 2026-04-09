<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquillaje extends Model
{
    /*
    |--------------------------------------------------------------------------
    | CAMPOS ASIGNABLES
    |--------------------------------------------------------------------------
    | Aquí definimos los campos que se podrán guardar y actualizar
    | masivamente en la tabla maquillajes.
    */
    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'marca_id',
        'precio',
        'stock',
        'imagen',
        'estado',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON MARCAS
    |--------------------------------------------------------------------------
    | Un maquillaje pertenece a una marca.
    */
    public function marcaRelacion()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
}