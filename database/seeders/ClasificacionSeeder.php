<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clasificaciones')->insert([
            [
                'nombre' => 'ATP',
                'descripcion' => 'Todo público'
            ],
            [
                'nombre' => 'PG-13',
                'descripcion' => 'Mayores de 13'
            ],
            [
                'nombre' => 'R',
                'descripcion' => 'Solo adultos'
            ]
        ]);
    }
}
