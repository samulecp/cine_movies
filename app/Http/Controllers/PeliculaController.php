<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
  use App\Models\Genero;
  use App\Models\Clasificacion;
  use Illuminate\Http\Request;
  
  class PeliculaController extends Controller
  {
      public function index()
      {
          $peliculas = Pelicula::with(['genero', 'clasificacion'])->get();
  
          return view('peliculas.index', compact('peliculas'));
      }
  
      public function create()
    {
        $generos = Genero::all();
        $clasificaciones = Clasificacion::all();

        return view('peliculas.create', compact('generos', 'clasificaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'duracion' => 'required|integer',
            'direccionPelicula' => 'required',
            'genero_id' => 'required',
            'clasificacion_id' => 'required'
        ]);

        Pelicula::create($request->all());

        return redirect()->route('peliculas.index')
                         ->with('success', 'Película creada correctamente');
    }

    public function edit($id)
    {
        $pelicula = Pelicula::findOrFail($id);

        $generos = Genero::all();
        $clasificaciones = Clasificacion::all();

        return view('peliculas.edit', compact(
            'pelicula',
            'generos',
            'clasificaciones'
        ));
    }

    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::findOrFail($id);

        $pelicula->update($request->all());

        return redirect()->route('peliculas.index')
                         ->with('success', 'Película actualizada');
    }

    public function destroy($id)
    {
        $pelicula = Pelicula::findOrFail($id);

        $pelicula->delete();
    }
}