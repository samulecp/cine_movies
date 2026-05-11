<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        try {
            if (! Schema::hasTable('users')) {
                return;
            }

            $email = env('ADMIN_EMAIL', 'admin@cine.local');
            $password = env('ADMIN_PASSWORD', 'Admin12345');

            $admin = User::where('email', $email)->first();

            if (! $admin) {
                User::create([
                    'name' => env('ADMIN_NAME', 'Admin'),
                    'lastname' => env('ADMIN_LASTNAME', 'Sistema'),
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'adm',
                ]);

                return;
            }

            if ($admin->role !== 'adm') {
                $admin->role = 'adm';
                $admin->save();
            }
        } catch (Throwable $exception) {
            // Evita romper el arranque si la base aun no esta lista.
        }
    }
}
