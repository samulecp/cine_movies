@extends('adminlte::page')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Categorías</h3>

    <a href="{{ route('categorias.create') }}" class="btn btn-success">
        + Nueva categoría
    </a>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>

                    <td>
                        <a href="{{ route('categorias.edit', $categoria) }}"
                           class="btn btn-primary btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('categorias.destroy', $categoria) }}"
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