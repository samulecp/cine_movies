<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraTable extends Migration
{
    public function up(): void
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID del usuario que realiza la acción
            $table->string('accion'); // Acción realizada (login, logout, acceso a página)
            $table->string('descripcion')->nullable(); // Detalle de la acción
            $table->timestamp('fecha_hora')->useCurrent(); // Fecha y hora del evento
            $table->string('ip_address')->nullable(); // Dirección IP del usuario
            $table->string('device_info')->nullable(); // Información del dispositivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
