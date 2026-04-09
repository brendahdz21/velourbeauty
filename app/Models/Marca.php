<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    /*
    |--------------------------------------------------------------------------
    | CAMPOS ASIGNABLES
    |--------------------------------------------------------------------------
    | Aquí definimos los campos que se podrán guardar y actualizar
    | masivamente en la tabla marcas.
    */
    protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
        'estado',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON MAQUILLAJES
    |--------------------------------------------------------------------------
    | Una marca puede tener muchos maquillajes.
    */
    public function maquillajes()
    {
        return $this->hasMany(Maquillaje::class, 'marca_id');
    }
}