<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteVirtualsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Insertar clientes virtuales
        DB::table('cliente_virtuals')->insert([
            [
                'FechaRegistro' => now(), // Fecha actual
                'telefono' => '555-1234',
                'carnet' => '12345678',
                'Iduser' => 1, // ID del usuario relacionado
            ],
        ]);
    }
}
