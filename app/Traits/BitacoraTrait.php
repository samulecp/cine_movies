<?php

namespace App\Traits;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

trait BitacoraTrait
{
    public function registrarBitacora($accion, $descripcion)
    {
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => $accion,
            'descripcion' => $descripcion,
            'fecha_hora' => now(),
            'ip_address' => request()->ip(),
            'device_info' => request()->header('User-Agent'),
        ]);
    }
}