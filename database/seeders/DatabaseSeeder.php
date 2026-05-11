<?php

namespace Database\Seeders;

use App\Models\DetalleCompra;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            AdminUserSeeder::class,
            PuestosSeeder::class,
            ClienteVirtualsSeeder::class,
            ClientePresencialsSeeder::class,
            CajerosSeeder::class,
            GeneroSeeder::class,
        ClasificacionSeeder::class,
        ]);
    }
}
