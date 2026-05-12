@extends('adminlte::page')

@section('title', 'Formatos')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        GESTIÓN DE FORMATOS
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{ route('formatos.create') }}"
           class="btn btn-primary btn-sm">

            Nuevo Formato
        </a>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped text-nowrap">

            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th width="160">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($formatos as $formato)

                    <tr>

                        <td>{{ $formato->id }}</td>

                        <td>{{ $formato->descripcion }}</td>

                        <td>
                            Bs. {{ number_format($formato->precio, 2) }}
                        </td>

                        
                        <td>

    <a href="{{ route('formatos.edit', $formato->id) }}"
       class="btn btn-warning btn-sm">

        Editar
    </a>

    <form action="{{ route('formatos.destroy', $formato->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('¿Eliminar formato?')">

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