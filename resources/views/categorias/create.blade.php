@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">Nueva Categoría</div>

    <div class="card-body">

        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf

            <input type="text" name="nombre" class="form-control" placeholder="Nombre">

            <button class="btn btn-success mt-3">
                Guardar
            </button>

        </form>

    </div>
</div>

@endsection