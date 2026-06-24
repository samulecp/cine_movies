<?php

namespace App\Http\Controllers;

use App\Models\Proyeccion;
use App\Models\Pelicula;
use App\Models\Sala;
use App\Models\Lenguaje;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\BitacoraTrait;

class ProyeccionController extends Controller
{
    use BitacoraTrait;

    public function index()
    {
        $proyecciones = Proyeccion::with(['pelicula','sala','lenguaje'])
            ->orderBy('fecha', 'desc')
            ->get();

        $this->registrarBitacora(
            'READ',
            'Listado de proyecciones'
        );

        return view('proyecciones.index', compact('proyecciones'));
    }

    public function create()
    {
        $this->registrarBitacora(
            'VIEW',
            'Accedió a formulario de creación de proyección'
        );

        return view('proyecciones.create', [
            'peliculas' => Pelicula::all(),
            'salas' => Sala::all(),
            'lenguajes' => Lenguaje::all(),
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'horaIni' => 'required',
        'sala_id' => 'required|exists:salas,id',
        'pelicula_id' => 'required|exists:peliculas,id',
        'lenguaje_id' => 'required|exists:lenguajes,id',
    ]);

    $pelicula = Pelicula::findOrFail($request->pelicula_id);

    // 🔥 convertir hora inicio correctamente
    $horaIni = Carbon::createFromFormat('H:i', $request->horaIni);

    // 🔥 calcular hora fin según duración
    $horaFin = $horaIni->copy()->addMinutes($pelicula->duracion);

    // 🔴 VALIDACIÓN DE CONFLICTO (MEJORADA)
    $conflicto = Proyeccion::where('sala_id', $request->sala_id)
        ->where('fecha', $request->fecha)
        ->where(function ($q) use ($horaIni, $horaFin) {
            $q->where(function ($q2) use ($horaIni, $horaFin) {
                $q2->where('horaIni', '<', $horaFin)
                   ->where('horaFin', '>', $horaIni);
            });
        })
        ->exists();

    if ($conflicto) {

        $this->registrarBitacora(
            'ERROR',
            'Intento fallido de proyección por conflicto de horario en sala ' . $request->sala_id
        );

        return back()->with('error', '❌ Conflicto de horario en esta sala');
    }

    // 🟢 CREAR PROYECCIÓN
    $proyeccion = Proyeccion::create([
        'fecha' => $request->fecha,
        'horaIni' => $horaIni->format('H:i:s'),
        'horaFin' => $horaFin->format('H:i:s'),
        'sala_id' => $request->sala_id,
        'pelicula_id' => $request->pelicula_id,
        'lenguaje_id' => $request->lenguaje_id,
    ]);

    // 🟡 BITÁCORA
    $this->registrarBitacora(
        'CREATE',
        'Proyección creada ID ' . $proyeccion->id .
        ' | Película: ' . $pelicula->nombre .
        ' | Sala: ' . $request->sala_id
    );

    return redirect()->route('proyecciones.index')
        ->with('success', '✔ Proyección creada correctamente');
}

    public function show($id)
    {
        $proyeccion = Proyeccion::with(['pelicula','sala','lenguaje'])
            ->findOrFail($id);

        $this->registrarBitacora(
            'READ',
            'Visualizó proyección ID ' . $id
        );

        return view('proyecciones.show', compact('proyeccion'));
    }

    public function edit($id)
    {
        $proyeccion = Proyeccion::findOrFail($id);

        $this->registrarBitacora(
            'VIEW',
            'Editando proyección ID ' . $id
        );

        return view('proyecciones.edit', [
            'proyeccion' => $proyeccion,
            'peliculas' => Pelicula::all(),
            'salas' => Sala::all(),
            'lenguajes' => Lenguaje::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $proyeccion = Proyeccion::findOrFail($id);

        $pelicula = Pelicula::findOrFail($request->pelicula_id);

        $horaIni = Carbon::parse($request->horaIni);
        $horaFin = $horaIni->copy()->addMinutes($pelicula->duracion);

        $proyeccion->update([
            'fecha' => $request->fecha,
            'horaIni' => $horaIni,
            'horaFin' => $horaFin,
            'sala_id' => $request->sala_id,
            'pelicula_id' => $request->pelicula_id,
            'lenguaje_id' => $request->lenguaje_id,
        ]);

        $this->registrarBitacora(
            'UPDATE',
            'Actualizó proyección ID ' . $id
        );

        return redirect()->route('proyecciones.index')
            ->with('success', 'Proyección actualizada');
    }

    public function destroy($id)
    {
        Proyeccion::findOrFail($id)->delete();

        $this->registrarBitacora(
            'DELETE',
            'Eliminó proyección ID ' . $id
        );

        return back()->with('success', 'Proyección eliminada');
    }

    
}