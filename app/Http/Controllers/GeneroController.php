<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::all();

        return view('generos.index', compact('generos'));
    }

    public function create()
    {
        return view('generos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        Genero::create($request->all());
        $this->registrarBitacora(
    'CREATE',
    'Creó genero: ' . $request->nombre
);
        return redirect()->route('generos.index');
    }

    public function edit($id)
    {
        $genero = Genero::findOrFail($id);

        return view('generos.edit', compact('genero'));
    }

    public function update(Request $request, $id)
    {
        $genero = Genero::findOrFail($id);

        $genero->update($request->all());
        $this->registrarBitacora(
    'UPDATE',
    'Editó genero: ' . $genero->nombre
);
        return redirect()->route('generos.index');
    }

    public function destroy($id)
    {
        $genero = Genero::findOrFail($id);

        $genero->delete();
        $this->registrarBitacora(
    'DELETE',
    'Eliminó genero: ' . $genero->nombre
);
        return redirect()->route('generos.index');
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