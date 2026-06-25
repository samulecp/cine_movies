@extends('layouts.cliente')

@section('content')

<div class="container py-4 text-white">

    <div class="card bg-dark border-0 shadow">

        <div class="card-header text-center">
            <h3>🎟 Ticket de Compra - Confitería</h3>
        </div>

        <div class="card-body">

            <h4 class="text-center text-warning mb-4">
                🍿 Dulcería Cine Movies
            </h4>

            <hr class="bg-secondary">

            <p><strong>Productos:</strong></p>

            <table class="table table-dark table-bordered">

                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($venta->detalles as $detalle)

                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>Bs {{ number_format($detalle->precio,2) }}</td>
                            <td>
                                Bs {{ number_format($detalle->cantidad * $detalle->precio,2) }}
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

            <hr class="bg-secondary">

            <p>
                <strong>Total pagado:</strong>
                Bs {{ number_format($venta->total,2) }}
            </p>

            <p>
                <strong>Método de pago:</strong>
                {{ $venta->pago->metodo_pago ?? 'QR' }}
            </p>

            <p>
                <strong>Estado:</strong>
                <span class="badge bg-success">Confirmado</span>
            </p>

        </div>

        <div class="card-footer text-center">

            <a href="{{ route('cartelera.index') }}"
               class="btn btn-warning">
                🍿 Volver a Cartelera
            </a>

        </div>

    </div>

</div>

@endsection