@extends('adminlte::page')

@section('content')

<div class="card">

    <div class="card-header">
        Editar Categoría
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @csrf
            @method('PUT')

            <label>Nombre</label>
            <input type="text"
                   name="nombre"
                   value="{{ $categoria->nombre }}"
                   class="form-control">

            <button class="btn btn-success mt-3">
                Actualizar
            </button>

        </form>

    </div>

</div>

@endsection