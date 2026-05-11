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
        Schema::create('cajeros', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->foreignId('Iduser')->constrained('users');

            $table->time('HoraEntrada'); // Hora de entrada del cajero
            $table->time('HoraSalida'); // Hora de salida del cajero
            $table->timestamps(); // Esto agrega created_at y updated_at
            $table->foreignId('Idpuesto')->constrained('puestos');

        //    $table->unsignedBigInteger('Iduser'); // ID del usuario relacionado
          //  $table->foreign('Iduser')
            //    ->references('id')->on('users')
           //     ->onDelete('cascade') // Eliminar registros si se elimina un usuario
        //        ->onUpdate('cascade'); // Actualizar la referencia si se actualiza el ID


          ///      $table->unsignedBigInteger('Idpuesto'); // ID del usuario relacionado
          //      $table->foreign('Idpuesto')
           //         ->references('id')->on('puestos')
            //        ->onDelete('cascade') // Eliminar registros si se elimina un usuario
              //      ->onUpdate('cascade'); // Actualizar la referencia si se actualiza el ID

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajeros'); // Eliminar tabla en caso de rollback
    }
};
