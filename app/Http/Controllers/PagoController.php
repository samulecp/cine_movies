<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\VentaPelicula;
use App\Models\ReservaButaca;
use App\Traits\BitacoraTrait;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    use BitacoraTrait;

    public function create(VentaPelicula $venta)
    {
        $venta->load(
            'proyeccion.pelicula',
            'detalles.butaca.fila',
            'detalles.butaca.columna'
        );

        return view(
            'pagos.create',
            compact('venta')
        );
    }

    public function store(Request $request, VentaPelicula $venta)
    {
        $request->validate([
            'metodo_pago' => 'required'
        ]);

        Pago::create([
            'venta_pelicula_id' => $venta->id,
            'metodo_pago' => $request->metodo_pago,
            'monto' => $venta->precio_total,
            'estado' => 'aprobado'
        ]);

        $venta->update([
            'estado' => 'pagada'
        ]);

        ReservaButaca::where(
            'proyeccion_id',
            $venta->proyeccion_id
        )
        ->where(
            'user_id',
            auth()->id()
        )
        ->update([
            'estado' => 'pagada'
        ]);

        $this->registrarBitacora(
            'PAGO',
            'Pago aprobado venta '.$venta->id
        );

        return redirect()
            ->route(
                'ventas.ticket',
                $venta->id
            );
    }
}