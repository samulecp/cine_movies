<?php

namespace App\Http\Controllers;

use App\Models\Lenguaje;
use Illuminate\Http\Request;

class LenguajeController extends Controller
{
    public function index()
    {
        $lenguajes = Lenguaje::all();
        return view('lenguajes.index', compact('lenguajes'));
    }

    public function create()
    {
        return view('lenguajes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idioma' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
        ]);

        Lenguaje::create($request->all());

        return redirect()->route('lenguajes.index')
            ->with('success', 'Lenguaje creado correctamente');
    }

    public function edit(Lenguaje $lenguaje)
    {
        return view('lenguajes.edit', compact('lenguaje'));
    }

    public function update(Request $request, Lenguaje $lenguaje)
    {
        $request->validate([
            'idioma' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
        ]);

        $lenguaje->update($request->all());

        return redirect()->route('lenguajes.index')
            ->with('success', 'Lenguaje actualizado correctamente');
    }

    public function destroy(Lenguaje $lenguaje)
    {
        $lenguaje->delete();

        return redirect()->route('lenguajes.index')
            ->with('success', 'Lenguaje eliminado correctamente');
    }
}