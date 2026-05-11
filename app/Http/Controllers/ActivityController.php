<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ActivityController extends Controller
{
    public function logActivity($action, $description)
    {
        if (Auth::check()) {
            DB::table('bitacora')->insert([
                'user_id' => Auth::id(), // Obtener ID del usuario autenticado
                'accion' => $action,
                'descripcion' => $description,
                'ip_address' => Request::ip(),
                'device_info' => Request::header('User-Agent'),
                'fecha_hora' => now(),
            ]);
        }
    }
}