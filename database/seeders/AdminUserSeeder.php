<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@cine.local');
        $password = env('ADMIN_PASSWORD', 'Admin12345');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Admin'),
                'lastname' => env('ADMIN_LASTNAME', 'Sistema'),
                'password' => Hash::make($password),
                'role' => 'adm',
            ]
        );
    }
}
