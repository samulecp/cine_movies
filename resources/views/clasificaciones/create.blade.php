@extends('adminlte::page')

@section('title', 'Nueva Clasificación')

@section('content_header')
    <h1>Nueva Clasificación</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('clasificaciones.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Descripción</label>

                <textarea name="descripcion"
                          class="form-control"></textarea>
            </div>

            <button class="btn btn-success">
                Guardar
            </button>

        </form>

    </div>
</div>

@stop