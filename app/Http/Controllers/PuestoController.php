<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PuestoController extends Controller
{
    public function index()
    {
        $puestos = Puesto::latest()->get();
        return view('puestos.index', compact('puestos'));
    }
    public function create()
    {
        return view('puestos.create');
    }
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|max:100',]);
        $puesto = Puesto::create(['nombre' => $request->nombre]);
       $this->registrarBitacora(

        'CREATE',

        'Creó puesto: ' . $puesto->nombre
    );
        return redirect()->route('puestos.index')->with('success', 'Puesto registrado correctamente');
    }
    public function edit(Puesto $puesto)
    {
        return view('puestos.edit', compact('puesto'));
    }
    public function update(Request $request, Puesto $puesto)
    {
        $request->validate(['nombre' => 'required|max:100',]);
        $puesto->update(['nombre' => $request->nombre]);
        $this->registrarBitacora(

        'UPDATE',

        'Editó puesto: ' . $puesto->nombre
    );
        return redirect()->route('puestos.index')->with('success', 'Puesto actualizado correctamente');
    }
    public function destroy(Puesto $puesto)
    {
        $this->registrarBitacora(

        'DELETE',

        'Eliminó puesto: ' . $puesto->nombre
    );
    $puesto->delete();
    return redirect()->route('puestos.index')->with('success', 'Puesto eliminado correctamente');
        
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
