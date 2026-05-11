@extends('adminlte::page')

@section('title', 'Editar Género')

@section('content_header')
    <h1>Editar Género</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('generos.update', $genero->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ $genero->nombre }}">
            </div>

            <button class="btn btn-primary">
                Actualizar
            </button>

        </form>

    </div>
</div>

@stop