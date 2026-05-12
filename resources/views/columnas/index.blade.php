@extends('adminlte::page')

@section('title', 'Columnas')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        GESTIÓN DE COLUMNAS
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('columnas.create') }}"
           class="btn btn-primary btn-sm">

            Nueva Columna

        </a>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped text-nowrap">

            <thead class="bg-dark text-white">

                <tr>
                    <th>ID</th>
                    <th>Número</th>
                    <th width="160">Acciones</th>
                </tr>

            </thead>

            <tbody>

                @foreach($columnas as $columna)

                    <tr>

                        <td>{{ $columna->id }}</td>

                        <td>{{ $columna->numero }}</td>

                        <td>

                            <a href="{{ route('columnas.edit', $columna->id) }}"
                               class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form action="{{ route('columnas.destroy', $columna->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar columna?')">

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