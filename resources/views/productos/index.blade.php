@extends('adminlte::page')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Productos</h3>

    <a href="{{ route('productos.create') }}" class="btn btn-success">
        + Nuevo producto
    </a>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre ?? '-' }}</td>
                    <td>Bs {{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>

                    <td>
                        <a href="{{ route('productos.edit', $producto) }}"
                           class="btn btn-primary btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('productos.destroy', $producto) }}"
                              method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection