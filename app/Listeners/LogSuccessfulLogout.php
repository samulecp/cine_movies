<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        DB::table('bitacora')->insert([
            'user_id' => $event->user->id,
            'accion' => 'Cierre de sesión',
            'descripcion' => 'Usuario cerró sesión',
            'ip_address' => Request::ip(),
            'device_info' => Request::header('User-Agent'),
            'fecha_hora' => now(),
        ]);
    }
}