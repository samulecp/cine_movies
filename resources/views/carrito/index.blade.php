@extends('layouts.cliente')

@section('content')

<h2 class="text-white text-center">🛒 Carrito</h2>

<table class="table table-dark">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>

    @php $total = 0; @endphp

    @foreach(session('carrito', []) as $item)
        @php
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        @endphp

        <tr>
            <td>{{ $item['nombre'] }}</td>
            <td>{{ $item['cantidad'] }}</td>
            <td>Bs {{ $subtotal }}</td>
        </tr>
    @endforeach
</table>

<h4 class="text-white">Total: Bs {{ $total }}</h4>

<form action="{{ route('carrito.checkout') }}" method="POST">
    @csrf

    <button class="btn btn-success">
        Pagar productos
    </button>

</form>

@endsection