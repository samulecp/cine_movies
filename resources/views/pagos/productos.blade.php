@extends('layouts.cliente')

@section('content')

<div class="card text-white bg-dark">

    <div class="card-header text-center">
        <h3>💳 Pago de Productos</h3>
    </div>

    <div class="card-body">

        <h4 class="text-center mb-4">
            Total: Bs {{ $venta->total }}
        </h4>

        <form action="{{ route('pagos.productos.store', $venta->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Método de Pago</label>

                <select name="metodo_pago" class="form-control">
                    <option value="QR">QR</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>

            <button class="btn btn-success btn-block mt-3">
                Confirmar Pago
            </button>

        </form>

    </div>
</div>

@endsection