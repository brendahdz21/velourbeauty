<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //Método para añadir cambios a la BD
    public function up(): void
    {
        Schema::create('marcas', function (Blueprint $table) {

            //Campos de la tabla Marcas
            $table->id();
            $table->string('nombre');
            $table->string('imagen');
            $table->string('descripcion');
            $table->boolean('estado')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    //Quitar los cambios de una migración
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};