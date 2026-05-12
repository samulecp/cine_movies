@extends('adminlte::page')
@section('title', 'Salas')
@section('content_header')
    <h1 class="text-lg md:text-xl font-bold"> GESTIÓN
        DE SALAS </h1>
@stop
@section('content') <div class="card">
        <div class="card-header"> <a href="{{ route('salas.create') }}" class="btn btn-primary btn-sm"> Nueva Sala </a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-nowrap">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Formato</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th width="160">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salas as $sala)
                        <tr>
                            <td>{{ $sala->id }}</td>
                            <td>{{ $sala->formato->descripcion }}</td>
                            <td>{{ $sala->capacidad }}</td>
                            <td>
                                @if ($sala->estado)
                                    <span class="badge badge-success"> Disponible </span>
                                @endif
                            </td>
                            <td>

    <a href="{{ route('salas.edit', $sala->id) }}"
       class="btn btn-warning btn-sm">

        Editar
    </a>

    <form action="{{ route('salas.destroy', $sala->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar sala?')">

            Eliminar
        </button>

    </form>

</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div> @stop
