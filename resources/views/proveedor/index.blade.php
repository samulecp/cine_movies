@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>LISTA DE PROVEEDORES</h1>
@stop

@section('content')

<a href="{{ route('proveedor.create') }}"
   class="btn btn-primary mb-3">

    Nuevo Proveedor

</a>

<table class="table table-bordered">

    <thead class="table-dark">

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

        @foreach($proveedores as $proveedor)

        <tr>

            <td>{{ $proveedor->id }}</td>

            <td>{{ $proveedor->nombre }}</td>

            <td>{{ $proveedor->telefono }}</td>

            <td>{{ $proveedor->email }}</td>

            <td>

                <a href="{{ route('proveedor.edit', $proveedor->id) }}"
                   class="btn btn-warning btn-sm">

                    Editar

                </a>

                <form action="{{ route('proveedor.destroy', $proveedor->id) }}"
                      method="POST"
                      style="display:inline;">

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

@stop