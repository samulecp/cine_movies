<?php

namespace App\Http\Controllers;
use App\Traits\BitacoraTrait;
use App\Models\Butaca;
use App\Models\Proyeccion;
use App\Models\ReservaButaca;
use Illuminate\Http\Request;

class ReservaButacaController extends Controller
{

use BitacoraTrait;
    public function seleccionar($id)
{
    $proyeccion = Proyeccion::findOrFail($id);

    $butacas = Butaca::with('fila','columna')
        ->get();

    $ocupadas = ReservaButaca::where(
        'proyeccion_id',
        $id
    )
    ->pluck('butaca_id')
    ->toArray();

    return view(
        'reservas.asientos',
        compact(
            'proyeccion',
            'butacas',
            'ocupadas'
        )
    );
}

public function store(Request $request)
{
    $request->validate([
        'proyeccion_id' => 'required|exists:proyeccions,id',
        'butacas' => 'required|array',
    ]);

    foreach ($request->butacas as $butaca_id) {

        // 🔴 evitar doble reserva (MUY IMPORTANTE)
        $existe = ReservaButaca::where('proyeccion_id', $request->proyeccion_id)
            ->where('butaca_id', $butaca_id)
            ->exists();

        if (!$existe) {
            ReservaButaca::create([
                'proyeccion_id' => $request->proyeccion_id,
                'butaca_id' => $butaca_id,
                'user_id' => auth()->id(),
                'estado' => 'reservada'
            ]);
        }
    }

    // bitácora (si tienes trait)
    $this->registrarBitacora(
        'CREATE',
        'Reserva de butacas en proyección ' . $request->proyeccion_id
    );

    return redirect()->back()->with('success', '✔ Reserva realizada correctamente');
}
}
