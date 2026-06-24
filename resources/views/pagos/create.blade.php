@extends('adminlte::page')

@section('title','Pago')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>

            {{ $venta->proyeccion->pelicula->nombre }}

        </h3>

    </div>

    <div class="card-body">

        <h4>

            Total:
            Bs {{ number_format($venta->precio_total,2) }}

        </h4>

        <form
            action="{{ route('pagos.store',$venta->id) }}"
            method="POST">

            @csrf

            <div class="form-group">

                <label>Método de Pago</label>

                <select
                    name="metodo_pago"
                    class="form-control">

                    <option value="QR">
                        QR
                    </option>

                    <option value="Tarjeta">
                        Tarjeta
                    </option>

                    <option value="Efectivo">
                        Efectivo
                    </option>

                </select>

            </div>

            <button
                class="btn btn-success">

                Confirmar Pago

            </button>

        </form>

    </div>

</div>

@stop