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
        Schema::table('maquillajes', function (Blueprint $table) {

            //Agregar relación con marcas
            $table->foreignId('marca_id')->nullable()->after('descripcion')
                ->constrained('marcas')
                ->onDelete('cascade');

            //Agregar estado del maquillaje
            $table->boolean('estado')->default(true)->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */

    //Quitar los cambios de una migración
    public function down(): void
    {
        Schema::table('maquillajes', function (Blueprint $table) {

            //Eliminar llave foránea y campos agregados
            $table->dropConstrainedForeignId('marca_id');
            $table->dropColumn('estado');
        });
    }
};