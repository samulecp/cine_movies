@extends('adminlte::page')

@section('content')

<div class="card">

    <div class="card-header">
        Editar Producto
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('productos.update', $producto) }}">
            @csrf
            @method('PUT')

            <label>Nombre</label>
            <input type="text"
                   name="nombre"
                   value="{{ $producto->nombre }}"
                   class="form-control mb-2">

            <label>Precio</label>
            <input type="number"
                   name="precio"
                   value="{{ $producto->precio }}"
                   class="form-control mb-2">

            <label>Stock</label>
            <input type="number"
                   name="stock"
                   value="{{ $producto->stock }}"
                   class="form-control mb-2">

            <label>Categoría</label>
            <select name="categoria_id" class="form-control mb-3">
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-success">
                Actualizar
            </button>

        </form>

    </div>

</div>

@endsection