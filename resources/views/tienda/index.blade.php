@extends('layouts.cliente')

@section('content')
@php
    $imagenes = [
            1 => '/img/cocagrande.jpg',
            2 => '/img/cocapeque.avif',
            3 => '/img/pipocagrande.webp',
            4 => '/img/pipocapeque.jpg',
            5 => '/img/agua.webp',
        ];
@endphp

<style>
    body {
        background: #2c3034;
        color: white;
    }

    .producto-card {
        background: #3a3f44;
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
    }

    .producto-card img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .producto-body {
        padding: 8px;
        text-align: center;
    }

    .precio {
        color: #ffc107;
        font-weight: bold;
        margin-bottom: 6px;
    }

    /* ===== SOLO LO QUE FALTABA ===== */
    .qty-control {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #2f343a;
        border-radius: 8px;
        padding: 4px;
        width: fit-content;
        margin: 0 auto 6px auto;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border: none;
        background: #444b52;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.15s;
    }

    .qty-btn:hover {
        background: #ffc107;
        color: #1b1b1b;
    }

    .qty-input {
        width: 40px;
        text-align: center;
        border: none;
        background: transparent;
        color: white;
        font-weight: bold;
        outline: none;
    }

    .add-btn {
        width: 100%;
        background: #ffc107;
        border: none;
        padding: 6px;
        border-radius: 8px;
        font-weight: bold;
        color: #1b1b1b;
        cursor: pointer;
    }

    .add-btn:hover {
        background: #e0a800;
    }

    .categoria-title {
        color: #ffc107;
        border-bottom: 1px solid #444;
        margin-top: 25px;
        margin-bottom: 10px;
        padding-bottom: 5px;
    }
</style>

<div class="container py-4">

    <h2 class="text-center mb-4">
        🍿 Confitería
    </h2>

    <div class="text-center mb-4">
        <a href="{{ route('carrito.index') }}" class="btn btn-warning">
            🛒 Ver Carrito
        </a>
    </div>

    @foreach ($categorias as $categoria)

        <h5 class="categoria-title">
            {{ $categoria->nombre }}
        </h5>

        <div class="row">

            @foreach ($categoria->productos as $producto)

                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">

                    <div class="producto-card">

                        {{-- 👇 NO TOCO TU RUTA DE IMAGEN --}}
                        <img src="{{ $imagenes[$producto->id] ?? '/img/default.jpg' }}">

                        <div class="producto-body">

                            <h6>{{ $producto->nombre }}</h6>

                            <div class="precio">
                                Bs {{ number_format($producto->precio,2) }}
                            </div>

                            <form action="{{ route('carrito.add') }}" method="POST">

                                @csrf

                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                <!-- CONTROL DE CANTIDAD -->
                                <div class="qty-control">

                                    <button type="button" class="qty-btn" onclick="changeQty(this, -1)">
                                        −
                                    </button>

                                    <input type="number"
                                           name="cantidad"
                                           value="1"
                                           min="1"
                                           class="qty-input">

                                    <button type="button" class="qty-btn" onclick="changeQty(this, 1)">
                                        +
                                    </button>

                                </div>

                                <!-- AGREGAR -->
                                <button type="submit" class="add-btn">
                                    🛒 Agregar
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endforeach

</div>

<script>
function changeQty(btn, value) {
    let input = btn.parentElement.querySelector('.qty-input');
    let newValue = parseInt(input.value) + value;

    if (newValue >= 1) {
        input.value = newValue;
    }
}
</script>

@endsection