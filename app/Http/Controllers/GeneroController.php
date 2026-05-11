<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

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

        return redirect()->route('generos.index');
    }

    public function destroy($id)
    {
        $genero = Genero::findOrFail($id);

        $genero->delete();

        return redirect()->route('generos.index');
    }
}