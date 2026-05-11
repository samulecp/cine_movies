<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
  // Insertar puestos
  DB::table('puestos')->insert([
    [     'nombre' => 'administrador',   ],
    [     'nombre' => 'cajero',   ],
   ]);


 }
}
