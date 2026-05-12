<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $proveedores = Proveedor::all();

    return view('proveedor.index', compact('proveedores'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('proveedor.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $proveedor = Proveedor::create([

        'nombre' => $request->nombre,

        'telefono' => $request->telefono,

        'email' => $request->email,
    ]);

    $this->registrarBitacora(

        'CREATE',

        'Creó proveedor: ' . $proveedor->nombre
    );

    return redirect()->route('proveedor.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $proveedor = Proveedor::findOrFail($id);

    return view('proveedor.edit', compact('proveedor'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $proveedor = Proveedor::findOrFail($id);

    $proveedor->update([

        'nombre' => $request->nombre,

        'telefono' => $request->telefono,

        'email' => $request->email,
    ]);

    $this->registrarBitacora(

        'UPDATE',

        'Editó proveedor: ' . $proveedor->nombre
    );

    return redirect()->route('proveedor.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $proveedor = Proveedor::findOrFail($id);

    $nombre = $proveedor->nombre;

    $proveedor->delete();

    $this->registrarBitacora(

        'DELETE',

        'Eliminó proveedor: ' . $nombre
    );

    return redirect()->route('proveedor.index');
}

    private function registrarBitacora($accion, $descripcion)
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
