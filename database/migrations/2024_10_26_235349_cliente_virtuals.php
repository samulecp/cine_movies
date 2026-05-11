<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente_virtuals', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('carnet')->unique()->nullable(); // Hacer 'carnet' único y opcional

            $table->date('FechaRegistro'); // Fecha de registro
            $table->string('telefono'); // Teléfono
            $table->timestamps(); // Esto agrega created_at y updated_at

            $table->unsignedBigInteger('Iduser'); // ID del usuario relacionado
            $table->foreign('Iduser')
                ->references('id')->on('users')
                ->onDelete('cascade') // Eliminar registros si se elimina un usuario
                ->onUpdate('cascade'); // Actualizar la referencia si se actualiza el ID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_virtuals'); // Eliminar tabla en caso de rollback
    }
};
