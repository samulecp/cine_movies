<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        DB::table('bitacora')->insert([
            'user_id' => $event->user->id,
            'accion' => 'Inicio de sesión',
            'descripcion' => 'Usuario inició sesión',
            'ip_address' => Request::ip(),
            'device_info' => Request::header('User-Agent'),
            'fecha_hora' => now(),
        ]);
    }
}