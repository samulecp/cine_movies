<?php

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
if (!function_exists('registrarBitacora')) {

    function registrarBitacora($accion, $descripcion)
    {
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => $accion,
            'descripcion' => $descripcion,
            'fecha_hora' => now(),
            'ip_address' => request()->ip(),
            'device_info' => request()->userAgent(),
        ]);
    }
}