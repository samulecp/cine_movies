@extends('layouts.cliente')

@section('content')

<div class="container py-3">

    <h2 class="text-white mb-3">📊 Reportes del Cine</h2>

    {{-- 🔥 FILTROS --}}
    <form method="GET" class="mb-3">

        <input type="date" name="desde" value="{{ $desde }}" class="form-control d-inline w-auto">

        <input type="date" name="hasta" value="{{ $hasta }}" class="form-control d-inline w-auto">

        <button class="btn btn-primary">Filtrar</button>

        <a href="{{ route('reportes.pdf', request()->all()) }}" class="btn btn-danger">
            PDF
        </a>

        <a href="{{ route('reportes.csv', request()->all()) }}" class="btn btn-success">
            CSV
        </a>

    </form>

    {{-- 🎬 PELÍCULAS --}}
    <div class="card bg-dark text-white mb-3 p-3">

        <h4>🎬 Ganancias por Película</h4>

        <table class="table table-dark">
            <tr>
                <th>Película</th>
                <th>Total</th>
            </tr>

            @foreach($gananciasPeliculas as $ventas)
                <tr>
                    <td>{{ $ventas->first()->proyeccion->pelicula->nombre ?? '' }}</td>
                    <td>{{ $ventas->sum('precio_total') }}</td>
                </tr>
            @endforeach
        </table>

    </div>

    {{-- 🍿 PRODUCTOS --}}
    <div class="card bg-dark text-white mb-3 p-3">

        <h4>🍿 Productos más vendidos</h4>

        <table class="table table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>

            @foreach($topProductos as $items)
                <tr>
                    <td>{{ $items->first()->producto->nombre ?? '' }}</td>
                    <td>{{ $items->sum('cantidad') }}</td>
                </tr>
            @endforeach
        </table>

    </div>

    {{-- 🎞 FORMATOS --}}
    <div class="card bg-dark text-white p-3">

        <h4>🎞 Formatos más usados</h4>

        <table class="table table-dark">
            <tr>
                <th>Formato</th>
                <th>Uso</th>
            </tr>

            @foreach($formatos as $items)
                <tr>
                    <td>{{ $items->first()->proyeccion->sala->formato->nombre ?? '' }}</td>
                    <td>{{ $items->count() }}</td>
                </tr>
            @endforeach
        </table>

    </div>

</div>

@endsection