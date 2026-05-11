<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 // Insertar usuarios
 DB::table('users')->insert([
    [
        'name' => 'John',
        'lastname' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => Hash::make('password123'), // Asegúrate de hashear la contraseña
        'role' => 'usu',
    ],
    [
        'name' => 'Jane',
        'lastname' => 'Smith',
        'email' => 'jane.smith@example.com',
        'password' => Hash::make('password123'),
        'role' => 'tra',
    ],
    [
        'name' => 'Alice',
        'lastname' => 'Johnson',
        'email' => 'alice.johnson@example.com',
        'password' => Hash::make('password123'),
        'role' => 'tra',
    ],
    [
        'name' => 'Bob',
        'lastname' => 'Brown',
        'email' => 'bob.brown@example.com',
        'password' => Hash::make('password123'),
        'role' => 'tra',
    ],
]);
}
}
