<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Registrar actividad en bitácora
     */
    public function logActivity($action, $description)
    {
        if (!Auth::check()) {
            return;
        }

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => $action,
            'descripcion' => $description,
            'fecha_hora' => now(),
            'ip_address' => request()->ip(),
            'device_info' => request()->header('User-Agent'),
        ]);
    }
}