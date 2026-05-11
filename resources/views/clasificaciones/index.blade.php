@extends('adminlte::page')

@section('title', 'Clasificaciones')

@section('content_header')
    <h1>Lista de Clasificaciones</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <a href="{{ route('clasificaciones.create') }}"
           class="btn btn-success mb-3">

            Nueva Clasificación
        </a>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th width="220">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($clasificaciones as $clasificacion)

                <tr>

                    <td>{{ $clasificacion->id }}</td>

                    <td>{{ $clasificacion->nombre }}</td>

                    <td>{{ $clasificacion->descripcion }}</td>

                    <td>

                        <a href="{{ route('clasificaciones.edit', $clasificacion->id) }}"
                           class="btn btn-warning btn-sm">

                            Editar
                        </a>

                        <form action="{{ route('clasificaciones.destroy', $clasificacion->id) }}"
                              method="POST"
                              style="display:inline-block">

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

@stop