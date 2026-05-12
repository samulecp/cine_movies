@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')

<form action="{{ route('proveedor.update', $proveedor->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Nombre</label>

        <input type="text"
               name="nombre"
               class="form-control"
               value="{{ $proveedor->nombre }}">

    </div>

    <div class="mb-3">

        <label>Teléfono</label>

        <input type="text"
               name="telefono"
               class="form-control"
               value="{{ $proveedor->telefono }}">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="email"
               class="form-control"
               value="{{ $proveedor->email }}">

    </div>

    <button class="btn btn-primary">

        Actualizar

    </button>

</form>

@stop