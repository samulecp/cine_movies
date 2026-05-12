@extends('adminlte::page')

@section('title', 'Crear Proveedor')

@section('content_header')
    <h1>Nuevo Proveedor</h1>
@stop

@section('content')

<form action="{{ route('proveedor.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Nombre</label>

        <input type="text"
               name="nombre"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Teléfono</label>

        <input type="text"
               name="telefono"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="email"
               class="form-control">

    </div>

    <button class="btn btn-success">

        Guardar

    </button>

</form>

@stop