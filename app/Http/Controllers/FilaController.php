<?php

namespace App\Http\Controllers;

use App\Models\Fila;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilaController extends Controller
{
    public function index()
    {
        $filas = Fila::all();

        return view('filas.index', compact('filas'));
    }

    public function create()
    {
        return view('filas.create');
    }

    public function store(Request $request)
    {
        $fila = Fila::create([
            'letra' => $request->letra
        ]);

        $this->registrarBitacora(
            'CREATE',
            'Registró fila ' . $fila->letra
        );

        return redirect()
            ->route('filas.index');
    }

    public function edit(Fila $fila)
    {
        return view('filas.edit', compact('fila'));
    }

    public function update(Request $request, Fila $fila)
    {
        $fila->update([
            'letra' => $request->letra
        ]);

        $this->registrarBitacora(
            'UPDATE',
            'Actualizó fila ' . $fila->letra
        );

        return redirect()
            ->route('filas.index');
    }

    public function destroy(Fila $fila)
    {
        $this->registrarBitacora(
            'DELETE',
            'Eliminó fila ' . $fila->letra
        );

        $fila->delete();

        return redirect()
            ->route('filas.index');
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