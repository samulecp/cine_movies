@extends('layouts.cliente')

@section('content')

<style>
    .report-card {
        background: #2f343a;
        border-radius: 12px;
        padding: 20px;
        color: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .report-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        border-bottom: 1px solid #444;
        padding-bottom: 8px;
    }

    .table-dark-custom {
        width: 100%;
        color: #fff;
    }

    .table-dark-custom th {
        background: #1f2327;
        padding: 10px;
    }

    .table-dark-custom td {
        padding: 10px;
        border-bottom: 1px solid #444;
    }

    .badge-soft {
        padding: 5px 10px;
        border-radius: 8px;
        background: #ffc107;
        color: #000;
        font-weight: bold;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    @media(max-width: 768px){
        .grid { grid-template-columns: 1fr; }
    }
</style>

<div class="container py-3">

    <h2 class="text-white mb-4">📊 Reporte General del Cine</h2>

    {{-- ========================= --}}
    {{-- 🎬 GANANCIAS PELÍCULAS --}}
    {{-- ========================= --}}
    <div class="report-card mb-4">

        <div class="report-title">🎬 Ganancias por Película</div>

        <table class="table-dark-custom">
            <tr>
                <th>Película</th>
                <th>Total Bs</th>
            </tr>

            @foreach($gananciasPeliculas as $ventas)

                <tr>
                    <td>
                        {{ $ventas->first()->proyeccion->pelicula->nombre ?? 'Sin datos' }}
                    </td>

                    <td>
                        {{ number_format($ventas->sum('precio_total'), 2) }}
                    </td>
                </tr>

            @endforeach
        </table>

    </div>

    <div class="grid">

        {{-- ========================= --}}
        {{-- 🍿 TOP PRODUCTOS --}}
        {{-- ========================= --}}
        <div class="report-card">

            <div class="report-title">🍿 Productos más vendidos</div>

            <table class="table-dark-custom">
                <tr>
                    <th>Producto</th>
                    <th>Cant</th>
                </tr>

                @foreach($topProductos as $items)
                    <tr>
                        <td>
                            {{ $items->first()->producto->nombre ?? 'Sin producto' }}
                        </td>
                        <td>
                            {{ $items->sum('cantidad') }}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

        {{-- ========================= --}}
        {{-- 🎞 FORMATOS --}}
        {{-- ========================= --}}
        <div class="report-card">

            <div class="report-title">🎞 Formatos más usados</div>

            <table class="table-dark-custom">
                <tr>
                    <th>Formato</th>
                    <th>Uso</th>
                </tr>

                @foreach($formatos as $items)
                    <tr>
                        <td>
                            {{ $items->first()->proyeccion->sala->formato->nombre ?? 'Sin formato' }}
                        </td>
                        <td>
                            <span class="badge-soft">
                                {{ $items->count() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

    </div>

</div>

@endsection