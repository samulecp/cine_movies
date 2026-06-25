<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CineMovies  {{ $pelicula->titulo }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            color: white;
        }

        .movie-header {
            background: #1e293b;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .funcion-card {
            background: #1e293b;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .funcion-card:hover {
            transform: scale(1.02);
        }

        .badge-sala {
            background: #22c55e;
            color: black;
        }

        .badge-hora {
            background: #f59e0b;
            color: black;
        }

        .btn-cine {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-cine:hover {
            background: #dc2626;
        }
    </style>
</head>

<body >

<div class="container mt-4">

    <a href="{{ route('cartelera.index') }}" class="btn btn-secondary mb-3">← Volver a cartelera</a>

    {{-- INFO PELÍCULA --}}
    <div class="movie-header">
        <h2>{{ $pelicula->titulo }}</h2>
        <p>{{ $pelicula->sinopsis }}</p>

        <p>
            <strong>Duración:</strong> {{ $pelicula->duracion }} min
        </p>
    </div>

    {{-- FUNCIONES --}}
    <h4 class="mb-3">🎬 Funciones disponibles</h4>

    @if($proyecciones->count())

        @foreach($proyecciones as $proyeccion)

            <div class="funcion-card">

    <div class="row align-items-center">

        {{-- HORA --}}
        <div class="col-md-3">
            <span class="badge badge-hora">
                🕒 {{ $proyeccion->horaIni }}
            </span>
        </div>

        

        {{-- FECHA --}}
        <div class="col-md-3">
            📅 {{ $proyeccion->fecha }}
        </div>

        {{-- FORMATO --}}
        <div class="col-md-3">
            <span class="badge badge-sala">
                🎥 {{ $proyeccion->sala->formato->descripcion ?? 'Sin formato' }}
            </span>
        </div>

        {{-- PRECIO (DESDE FORMATO) --}}
        <div class="col-md-3 text-end">

            <div class="mb-1">
                💲 {{ $proyeccion->sala->formato->precio ?? '0.00' }}
            </div>

            <a href="{{ route('asientos.seleccionarCliente', $proyeccion->id) }}"
   class="btn btn-success">
    Ver Asientos
</a>

        </div>

    </div>

</div>

        @endforeach

    @else
        <div class="alert alert-warning">
            No hay funciones disponibles para esta película.
        </div>
    @endif

</div>

</body>
</html>