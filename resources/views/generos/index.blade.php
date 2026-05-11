@extends('adminlte::page')

@section('title', 'Géneros')

@section('content_header')
    <h1>Lista de Géneros</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <a href="{{ route('generos.create') }}"
           class="btn btn-success mb-3">

            Nuevo Género
        </a>

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="220">Acciones</th>
                </tr>

            </thead>

            <tbody>

                @foreach($generos as $genero)

                <tr>

                    <td>{{ $genero->id }}</td>

                    <td>{{ $genero->nombre }}</td>

                    <td>

                        <a href="{{ route('generos.edit', $genero->id) }}"
                           class="btn btn-warning btn-sm">

                            Editar
                        </a>

                        <form action="{{ route('generos.destroy', $genero->id) }}"
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