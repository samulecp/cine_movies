@extends('adminlte::page')

@section('title','Resumen de Compra')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>

            {{ $proyeccion->pelicula->nombre }}

        </h3>

    </div>

    <div class="card-body">

        <h5>Asientos</h5>

        <ul>

        @foreach($butacas as $butaca)

            <li>

                {{ $butaca->fila->letra }}
                {{ $butaca->columna->numero }}

            </li>

        @endforeach

        </ul>

        <hr>

        <p>

            Precio Unitario:

            <b>
                Bs {{ number_format($precioUnitario,2) }}
            </b>

        </p>

        <p>

            Total:

            <b>
                Bs {{ number_format($total,2) }}
            </b>

        </p>

        <form
            action="{{ route('ventas.store') }}"
            method="POST">

            @csrf

            <input
                type="hidden"
                name="proyeccion_id"
                value="{{ $proyeccion->id }}">

            @foreach($butacas as $butaca)

                <input
                    type="hidden"
                    name="butacas[]"
                    value="{{ $butaca->id }}">

            @endforeach

            <button
                class="btn btn-success">

                Continuar al Pago

            </button>

        </form>

    </div>

</div>

@endsection