<?php

namespace App\Http\Controllers;

use App\Models\VentaProducto;
use Illuminate\Http\Request;

class VentaProductoController extends Controller
{
    public function ticket($id)
{
    $venta = VentaProducto::with('detalles.producto')
        ->findOrFail($id);

    return view('tickets.productos', compact('venta'));
}
}
