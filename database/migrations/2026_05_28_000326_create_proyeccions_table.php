<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyeccions', function (Blueprint $table) {

            $table->id();

            $table->date('fecha');

            $table->time('horaIni');

            $table->time('horaFin');

            $table->foreignId('sala_id')
                ->constrained('salas')
                ->onDelete('cascade');

            $table->foreignId('pelicula_id')
                ->constrained('peliculas')
                ->onDelete('cascade');

            $table->foreignId('lenguaje_id')
                ->constrained('lenguajes')
                ->onDelete('cascade');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyeccions');
    }
};
