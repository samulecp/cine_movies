<?php

namespace App\Http\Controllers;

use App\Models\Columna;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColumnaController extends Controller
{
    public function index()
    {
        $columnas = Columna::all();

        return view('columnas.index', compact('columnas'));
    }

    public function create()
    {
        return view('columnas.create');
    }

    public function store(Request $request)
    {
        $columna = Columna::create([
            'numero' => $request->numero
        ]);

        $this->registrarBitacora(
            'CREATE',
            'Registró columna ' . $columna->numero
        );

        return redirect()
            ->route('columnas.index');
    }

    public function edit(Columna $columna)
    {
        return view('columnas.edit', compact('columna'));
    }

    public function update(Request $request, Columna $columna)
    {
        $columna->update([
            'numero' => $request->numero
        ]);

        $this->registrarBitacora(
            'UPDATE',
            'Actualizó columna ' . $columna->numero
        );

        return redirect()
            ->route('columnas.index');
    }

    public function destroy(Columna $columna)
    {
        $this->registrarBitacora(
            'DELETE',
            'Eliminó columna ' . $columna->numero
        );

        $columna->delete();

        return redirect()
            ->route('columnas.index');
    }

    private function registrarBitacora($accion, $descripcion)
    {
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => $accion,
            'descripcion' => $descripcion,
            'fecha_hora' => now()
        ]);
    }
}