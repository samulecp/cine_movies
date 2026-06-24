@extends('adminlte::page')

@section('title', 'Editar Lenguaje')

@section('content_header')
    <h1>EDITAR LENGUAJE</h1>
@stop

@section('content')

<div class="card p-3 shadow">

    <form action="{{ route('lenguajes.update', $lenguaje) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Idioma</label>
            <input type="text"
                   name="idioma"
                   class="form-control"
                   value="{{ $lenguaje->idioma }}"
                   required>
        </div>

        <div class="form-group mt-2">
            <label>Subtítulo</label>
            <input type="text"
                   name="subtitulo"
                   class="form-control"
                   value="{{ $lenguaje->subtitulo }}">
        </div>

        <div class="mt-3 d-flex justify-content-between">

            <a href="{{ route('lenguajes.index') }}" class="btn btn-secondary">
                Volver
            </a>

            <button class="btn btn-warning">
                Actualizar
            </button>

        </div>

    </form>

</div>

@stop