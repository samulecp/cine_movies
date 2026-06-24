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
        Schema::create('venta_peliculas', function (Blueprint $table) {

    $table->id();

    $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->foreignId('proyeccion_id')
        ->constrained('proyeccions')
        ->cascadeOnDelete();

    $table->decimal('precio_total',8,2)
        ->default(0);

    $table->string('estado')
        ->default('pendiente');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_peliculas');
    }
};
