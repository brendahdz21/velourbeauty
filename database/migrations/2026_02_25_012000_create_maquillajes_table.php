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
        Schema::create('maquillajes', function (Blueprint $table) {
            //Campos de la tabla Maquillajes
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('marca');
            $table->float('precio');
            $table->integer('stock');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    //Quitar los cambios de una migración
    public function down(): void
    {
        Schema::dropIfExists('maquillajes');
    }
};

