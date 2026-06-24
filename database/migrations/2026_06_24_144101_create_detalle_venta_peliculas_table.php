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
        Schema::create('detalle_venta_peliculas', function (Blueprint $table) {

    $table->id();

    $table->foreignId('venta_pelicula_id')
        ->constrained('venta_peliculas')
        ->cascadeOnDelete();

    $table->foreignId('butaca_id')
        ->constrained('butacas')
        ->cascadeOnDelete();

    $table->decimal('precio_venta',8,2);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta_peliculas');
    }
};
