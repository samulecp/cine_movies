<?php

namespace App\Http\Controllers;
use App\Models\Bitacora;
use App\Models\Pelicula;
  use App\Models\Genero;
  use App\Models\Clasificacion;
  use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->registrarBitacora(
            'CREATE',
            'Creó la película: ' . $request->nombre
        );
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
        $this->registrarBitacora(
            'UPDATE',
            'Editó la película: ' . $pelicula->nombre
        );
        return redirect()->route('peliculas.index')
                         ->with('success', 'Película actualizada');
    }

    public function destroy($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $this->registrarBitacora(
    'DELETE',
    'Eliminó la película: ' . $pelicula->nombre
);
        $pelicula->delete();
        return view('peliculas.index', compact('peliculas'));
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