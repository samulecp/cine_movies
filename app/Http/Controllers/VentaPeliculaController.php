<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\DetalleVentaPelicula;
use App\Models\Pelicula;
use App\Models\Proyeccion;
use App\Models\ReservaButaca;
use App\Models\VentaPelicula;
use App\Traits\BitacoraTrait;
use Illuminate\Http\Request;

class VentaPeliculaController extends Controller
{
    use BitacoraTrait;
    public function resumen(Request $request)
    {
        $request->validate([
            'proyeccion_id' => 'required',
            'butacas' => 'required|array|min:1'
        ]);

        $proyeccion = Proyeccion::with(
            'pelicula',
            'sala.formato'
        )->findOrFail($request->proyeccion_id);

        $butacas = Butaca::whereIn(
            'id',
            $request->butacas
        )->get();

        $precioUnitario =
            $proyeccion
                ->sala
                ->formato
                ->precio;

        $total =
            $butacas->count()
            *
            $precioUnitario;

        return view(
            'ventas.resumen',
            compact(
                'proyeccion',
                'butacas',
                'precioUnitario',
                'total'
            )
        );
    }

    public function store(Request $request)
{
    $proyeccion =
        Proyeccion::with(
            'sala.formato'
        )
        ->findOrFail(
            $request->proyeccion_id
        );

    $precio =
        $proyeccion
        ->sala
        ->formato
        ->precio;

    $cantidad =
        count(
            $request->butacas
        );

    $total =
        $precio
        *
        $cantidad;

    $venta =
        VentaPelicula::create([

            'user_id' =>
                auth()->id(),

            'proyeccion_id' =>
                $proyeccion->id,

            'precio_total' =>
                $total,

            'estado' =>
                'pendiente',
        ]);

    foreach(
        $request->butacas
        as
        $butacaId
    ){

        DetalleVentaPelicula::create([

            'venta_pelicula_id' =>
                $venta->id,

            'butaca_id' =>
                $butacaId,

            'precio_venta' =>
                $precio,
        ]);

        ReservaButaca::create([

            'proyeccion_id' =>
                $proyeccion->id,

            'butaca_id' =>
                $butacaId,

            'user_id' =>
                auth()->id(),

            'estado' =>
                'reservada'
        ]);
    }

    $this->registrarBitacora(
        'CREATE',
        'Venta de película ID '.$venta->id
    );

    return redirect()
        ->route(
            'pagos.create',
            $venta->id
        );
}


public function ticket(VentaPelicula $venta)
{
    $venta->load(
        'proyeccion.pelicula',
        'proyeccion.sala',
        'detalles.butaca.fila',
        'detalles.butaca.columna'
    );

    return view(
        'pagos.ticket',
        compact('venta')
    );
}

public function funciones(Pelicula $pelicula)
{
    $proyecciones = Proyeccion::with([
        'sala.formato',
        'lenguaje'
    ])
    ->where('pelicula_id', $pelicula->id)
    ->orderBy('fecha')
    ->orderBy('horaIni')
    ->get();

    return view(
        'peliculas.funciones',
        compact('pelicula', 'proyecciones')
    );
}
}
