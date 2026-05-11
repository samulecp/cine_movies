<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Cajero;
class CajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Cajero::create([
                'HoraEntrada' => '09:00:00',
                'HoraSalida' => '17:00:00',
                'Iduser' => 2, // ID del usuario relacionado
                'Idpuesto' => 2, // ID del usuario relacionado

            ]);///->assignrole('cajero');

            Cajero::create([
                'HoraEntrada' => '09:00:00',
                'HoraSalida' => '17:00:00',
                'Iduser' => 3, // ID del usuario relacionado
                'Idpuesto' => 2, // ID del usuario relacionado

            ]);///->assignrole('cajero');

            Cajero::create([
                'HoraEntrada' => '09:00:00',
                'HoraSalida' => '17:00:00',
                'Iduser' => 4, // ID del usuario relacionado
                'Idpuesto' => 2, // ID del usuario relacionado

            ]);///->assignrole('administrador');




        // Insertar cajeros
        // DB::table('cajeros')->insert([
        //     [
        //         'HoraEntrada' => '09:00:00',
        //         'HoraSalida' => '17:00:00',
        //         'Iduser' => 2, // ID del usuario relacionado
        //         'Idpuesto' => 2, // ID del usuario relacionado

        //     ],
        //     [
        //         'HoraEntrada' => '10:00:00',
        //         'HoraSalida' => '18:00:00',
        //         'Iduser' => 3,
        //         'Idpuesto' => 2, // ID del usuario relacionado

        //     ],
        //     [
        //         'HoraEntrada' => '09:00:00',
        //         'HoraSalida' => '17:00:00',
        //         'Iduser' => 4, // ID del usuario relacionado
        //         'Idpuesto' => 1, // ID del usuario relacionado

        //     ],
        // ]);
    }
}
