<!-- resources/views/peliculas/edit.blade.php -->

@extends('adminlte::page')

@section('title', 'Editar Película')

@section('content_header')
    <h1>EDITAR PELÍCULA</h1>
@stop

@section('content')

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('peliculas.update', $pelicula->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ $pelicula->nombre }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">Duración</label>

                <input type="number"
                       name="duracion"
                       class="form-control"
                       value="{{ $pelicula->duracion }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Dirección Película
                </label>

                <input type="text"
                       name="direccionPelicula"
                       class="form-control"
                       value="{{ $pelicula->direccionPelicula }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">Género</label>

                <select name="genero_id"
                        class="form-select"
                        required>

                    @foreach($generos as $genero)

                        <option value="{{ $genero->id }}"
                            {{ $pelicula->genero_id == $genero->id ? 'selected' : '' }}>

                            {{ $genero->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Clasificación
                </label>

                <select name="clasificacion_id"
                        class="form-select"
                        required>

                    @foreach($clasificaciones as $clasificacion)

                        <option value="{{ $clasificacion->id }}"
                            {{ $pelicula->clasificacion_id == $clasificacion->id ? 'selected' : '' }}>

                            {{ $clasificacion->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit"
                    class="btn btn-warning">

                <i class="fas fa-edit"></i>
                Actualizar

            </button>

            <a href="{{ route('peliculas.index') }}"
               class="btn btn-secondary">

                Volver

            </a>

        </form>

    </div>

</div>

@stop