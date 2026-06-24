@extends('adminlte::page')

@section('title', 'Proyecciones')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">
        GESTIÓN DE PROYECCIONES
    </h1>
@stop

@section('content')

<div class="card shadow rounded-lg">

    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

        <a href="{{ route('proyecciones.create') }}" class="btn btn-primary btn-sm">
            Nueva Proyección
        </a>

    </div>

    <div class="card-body table-responsive">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped text-nowrap">

            <thead class="bg-dark text-white">
                <tr>
                    <th>ID</th>
                    <th>Película</th>
                    <th>Sala</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Lenguaje</th>
                    <th width="200">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse($proyecciones as $proyeccion)

                    <tr>
                        <td>{{ $proyeccion->id }}</td>

                        <td>{{ $proyeccion->pelicula->nombre ?? '---' }}</td>

                        <td>{{ $proyeccion->sala->nombre ?? 'Sala #' . $proyeccion->sala_id }}</td>

                        <td>{{ $proyeccion->fecha }}</td>

                        <td>{{ $proyeccion->horaIni }}</td>

                        <td>{{ $proyeccion->horaFin }}</td>

                        <td>{{ $proyeccion->lenguaje->nombre ?? '---' }}</td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">

                                <a href="{{ route('proyecciones.edit', $proyeccion) }}"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <a href="{{ route('proyecciones.show', $proyeccion) }}"
                                   class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <a href="{{ url('/proyeccion/'.$proyeccion->id.'/asientos') }}"
                                   class="btn btn-success btn-sm">
                                    Asientos
                                </a>

                                <form action="{{ route('proyecciones.destroy', $proyeccion) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar proyección?')">
                                        Eliminar
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            No hay proyecciones registradas
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop