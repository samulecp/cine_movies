@extends('adminlte::page')

@section('title', 'Editar Clasificación')

@section('content_header')
    <h1>Editar Clasificación</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('clasificaciones.update', $clasificacion->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ $clasificacion->nombre }}">
            </div>

            <div class="mb-3">
                <label>Descripción</label>

                <textarea name="descripcion"
                          class="form-control">{{ $clasificacion->descripcion }}</textarea>
            </div>

            <button class="btn btn-primary">
                Actualizar
            </button>

        </form>

    </div>
</div>

@stop