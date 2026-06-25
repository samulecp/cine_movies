<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetalleVentaProducto;
use App\Models\Producto;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'categoria_id' => 'required'
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto','categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());

        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return back();
    }
    public function tienda()
{
    $categorias = Categoria::with('productos')->get();

    return view('tienda.index', compact('categorias'));
}


}
