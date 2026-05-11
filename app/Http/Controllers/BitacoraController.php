<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\View\View;

class BitacoraController extends Controller
{
    public function index(): View
    {
        $bitacoras = Bitacora::with('user')
            ->orderByDesc('fecha_hora')
            ->paginate(20);

        return view('admin.bitacora.index', compact('bitacoras'));
    }
}
