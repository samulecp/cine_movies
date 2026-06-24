@extends('adminlte::page')

@section('title', 'Lenguajes')

@section('content_header')
    <h1 class="font-bold">GESTIÓN DE LENGUAJES</h1>
@stop

@section('content')

<div class="card shadow rounded">

    <div class="card-header d-flex justify-content-between align-items-center">

        <a href="{{ route('lenguajes.create') }}" class="btn btn-primary btn-sm">
            Nuevo Lenguaje
        </a>

    </div>

    <div class="card-body table-responsive">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped text-nowrap">

            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Idioma</th>
                    <th>Subtítulo</th>
                    <th width="180">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($lenguajes as $lenguaje)

                    <tr>
                        <td>{{ $lenguaje->id }}</td>
                        <td>{{ $lenguaje->idioma }}</td>
                        <td>{{ $lenguaje->subtitulo ?? '---' }}</td>

                        <td>
                            <div class="d-flex gap-1">

                                <a href="{{ route('lenguajes.edit', $lenguaje) }}"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('lenguajes.destroy', $lenguaje) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar lenguaje?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No hay lenguajes registrados
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop