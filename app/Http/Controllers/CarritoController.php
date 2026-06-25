<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentaProducto;
use App\Models\Producto;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

public function index()
{
    $carrito = session()->get('carrito', []);

    $total = 0;

    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    return view('carrito.index', compact('carrito', 'total'));
}
   public function add(Request $request)
{
    $producto = Producto::findOrFail($request->producto_id);

    $carrito = session()->get('carrito', []);

    if(isset($carrito[$producto->id])) {
        $carrito[$producto->id]['cantidad'] += $request->cantidad;
    } else {
        $carrito[$producto->id] = [
            "nombre" => $producto->nombre,
            "precio" => $producto->precio,
            "cantidad" => $request->cantidad,
        ];
    }

    session()->put('carrito', $carrito);

    return back();
}

public function checkout()
{
    $carrito = session('carrito');

    $venta = VentaProducto::create([
        'user_id' => auth()->id(),
        'total' => collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']),
        'estado' => 'pendiente'
    ]);

    foreach ($carrito as $id => $item) {
        DetalleVentaProducto::create([
            'venta_producto_id' => $venta->id,
            'producto_id' => $id,
            'cantidad' => $item['cantidad'],
            'precio' => $item['precio'],
        ]);
    }

    session()->forget('carrito');

    return redirect()->route('pagos.productos.create', $venta->id);
}
}
