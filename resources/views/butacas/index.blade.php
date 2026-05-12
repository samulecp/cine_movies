@extends('adminlte::page')
@section('title', 'Butacas')
@section('content_header')
<h1 class="text-lg md:text-xl font-bold"> GESTIÓN DE BUTACAS </h1>
@stop
@section('content') <div class="card">
    <div class="card-header"> <a href="{{ route('butacas.create') }}" class="btn btn-primary btn-sm"> Nueva Butaca </a> </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Sala</th>
                    <th>Fila</th>
                    <th>Columna</th>
                    <th>Estado</th>
                    <th width="160">Acciones</th>
                </tr>
            </thead>
            <tbody> @foreach($butacas as $butaca) <tr>
                    <td>{{ $butaca->id }}</td>
                    <td>{{ $butaca->sala->id }}</td>
                    <td>{{ $butaca->fila->letra }}</td>
                    <td>{{ $butaca->columna->numero }}</td>
                    <td> <span class="badge badge-success"> {{ $butaca->estado }} </span> </td>
                    <td>

    <a href="{{ route('butacas.edit', $butaca->id) }}"
       class="btn btn-warning btn-sm">

        Editar
    </a>

    <form action="{{ route('butacas.destroy', $butaca->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar butaca?')">

            Eliminar
        </button>

    </form>

</td>
                </tr> @endforeach </tbody>
        </table>
    </div>
</div> @stop