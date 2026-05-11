<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            //dd($request->path()); // Esto mostrará la ruta antes de insertar
            // Registra el acceso del usuario en la bitácora
            DB::table('bitacora')->insert([
                'user_id' => Auth::id(),
                'accion' => 'Acceso a ruta',
                'descripcion' => 'El usuario accedió a ' . $request->path(),
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'fecha_hora' => now(),
            ]);
        }

        return $next($request);
    }
}
