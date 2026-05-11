<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\Request;

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

        return redirect()->route('clasificaciones.index');
    }

    public function destroy($id)
    {
        $clasificacion = Clasificacion::findOrFail($id);

        $clasificacion->delete();

        return redirect()->route('clasificaciones.index');
    }
}
