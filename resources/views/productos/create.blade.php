@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">Nuevo Producto</div>

    <div class="card-body">

        <form method="POST" action="{{ route('productos.store') }}">
            @csrf

            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre">

            <input type="number" name="precio" class="form-control mb-2" placeholder="Precio">

            <input type="number" name="stock" class="form-control mb-2" placeholder="Stock">

            <select name="categoria_id" class="form-control mb-2">
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>

            <button class="btn btn-success">
                Guardar
            </button>

        </form>

    </div>
</div>

@endsection