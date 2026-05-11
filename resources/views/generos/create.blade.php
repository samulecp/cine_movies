@extends('adminlte::page')

@section('title', 'Crear Género')

@section('content_header')
    <h1>Nuevo Género</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('generos.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Nombre</label>

                <input type="text"
                       name="nombre"
                       class="form-control">
            </div>

            <button class="btn btn-success">
                Guardar
            </button>

        </form>

    </div>
</div>

@stop