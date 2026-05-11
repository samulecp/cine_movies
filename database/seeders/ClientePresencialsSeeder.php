<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientePresencialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     // Insertar clientes presenciales
     DB::table('cliente_presencials')->insert([
        [
            'nombre' => 'Carlos Pérez',
            'ci' => '12345678',
            'nit' => '87654321',
        ],
        [
            'nombre' => 'Ana Gómez',
            'ci' => '23456789',
            'nit' => '98765432',
        ],
    ]);


}
}
