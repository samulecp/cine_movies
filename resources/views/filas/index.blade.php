@extends('adminlte::page')

@section('title', 'Filas')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        GESTIÓN DE FILAS
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('filas.create') }}"
           class="btn btn-primary btn-sm">

            Nueva Fila

        </a>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped text-nowrap">

            <thead class="bg-dark text-white">

                <tr>
                    <th>ID</th>
                    <th>Letra</th>
                    <th width="160">Acciones</th>
                </tr>

            </thead>

            <tbody>

                @foreach($filas as $fila)

                    <tr>

                        <td>{{ $fila->id }}</td>

                        <td>{{ $fila->letra }}</td>

                        <td>

                            <a href="{{ route('filas.edit', $fila->id) }}"
                               class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form action="{{ route('filas.destroy', $fila->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar fila?')">

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