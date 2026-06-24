@extends('adminlte::page')

@section('title', 'Crear Lenguaje')

@section('content_header')
    <h1>CREAR LENGUAJE</h1>
@stop

@section('content')

<div class="card p-3 shadow">

    <form action="{{ route('lenguajes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Idioma</label>
            <input type="text" name="idioma" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>Subtítulo</label>
            <input type="text" name="subtitulo" class="form-control">
        </div>

        <div class="mt-3 d-flex justify-content-between">

            <a href="{{ route('lenguajes.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

            <button class="btn btn-primary">
                Guardar
            </button>

        </div>

    </form>

</div>

@stop