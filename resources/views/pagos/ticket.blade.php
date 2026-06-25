@extends('layouts.cliente')

@section('title','Ticket')

@section('content')

<div class="card text-white bg-dark">

    <div class="card-body">

        <h2>CINE MOVIES</h2>

        <hr>

        <p>
            Película:
            {{ $venta->proyeccion->pelicula->nombre }}
        </p>

        <p>
            Sala:
            {{ $venta->proyeccion->sala->id }}
        </p>

        <p>
            Fecha:
            {{ $venta->proyeccion->fecha }}
        </p>

        <p>
            Hora:
            {{ $venta->proyeccion->horaIni }}
        </p>

        <p>
            Asientos:
        </p>

        <ul>

            @foreach($venta->detalles as $detalle)

                <li>

                    {{ $detalle->butaca->fila->letra }}
                    {{ $detalle->butaca->columna->numero }}

                </li>

            @endforeach

        </ul>

        <h4>
            Total:
            Bs {{ $venta->precio_total }}
        </h4>

    </div>

</div>

@stop