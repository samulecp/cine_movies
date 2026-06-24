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
        Schema::create('reserva_butacas', function (Blueprint $table) {

    $table->id();

    $table->foreignId('proyeccion_id')
        ->constrained('proyeccions')
        ->cascadeOnDelete();

    $table->foreignId('butaca_id')
        ->constrained('butacas')
        ->cascadeOnDelete();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->enum('estado', [
        'reservada',
        'pagada',
        'cancelada'
    ])->default('reservada');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_butacas');
    }
};
