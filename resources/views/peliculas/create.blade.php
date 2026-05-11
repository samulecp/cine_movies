<!-- resources/views/peliculas/create.blade.php -->

@extends('adminlte::page')

@section('title', 'Crear Película')

@section('content_header')
    <h1>CREAR PELÍCULA</h1>
@stop

@section('content')

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('peliculas.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duración</label>

                <input type="number"
                       name="duracion"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección Película</label>

                <input type="text"
                       name="direccionPelicula"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">

                <label class="form-label">Género</label>

                <select name="genero_id"
                        class="form-select"
                        required>

                    <option value="">Seleccione</option>

                    @foreach($generos as $genero)

                        <option value="{{ $genero->id }}">
                            {{ $genero->nombre }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Clasificación</label>

                <select name="clasificacion_id"
                        class="form-select"
                        required>

                    <option value="">Seleccione</option>

                    @foreach($clasificaciones as $clasificacion)

                        <option value="{{ $clasificacion->id }}">
                            {{ $clasificacion->nombre }}
                        </option>

                    @endforeach

                </select>

            </div>

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>
                Guardar

            </button>

            <a href="{{ route('peliculas.index') }}"
               class="btn btn-secondary">

                Volver

            </a>

        </form>

    </div>

</div>

@stop