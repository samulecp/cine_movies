<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
class ClasificacionController extends Controller
{
    public function index()
    {
        $clasificaciones = Clasificacion::all();

        return view('clasificaciones.index', compact('clasificaciones'));
    }

    public function create()
    {
        return view('clasificaciones.create');
    }

    public function store(Request $request)
    {
        Clasificacion::create($request->all());
        $this->registrarBitacora(
    'CREATE',
    'Creó clasificación: ' . $request->nombre
);
        return redirect()->route('clasificaciones.index');
    }

    public function edit($id)
    {
        $clasificacion = Clasificacion::findOrFail($id);

        return view('clasificaciones.edit', compact('clasificacion'));
    }

    public function update(Request $request, $id)
    {
        $clasificacion = Clasificacion::findOrFail($id);

        $clasificacion->update($request->all());
        $this->registrarBitacora(
    'UPDATE',
    'Editó clasificación: ' . $clasificacion->nombre
);
        return redirect()->route('clasificaciones.index');
    }

    public function destroy($id)
    {
        $clasificacion = Clasificacion::findOrFail($id);

        $clasificacion->delete();
        $this->registrarBitacora(
    'DELETE',
    'Eliminó clasificación: ' . $clasificacion->nombre
);
        return redirect()->route('clasificaciones.index');
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
