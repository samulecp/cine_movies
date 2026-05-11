@extends('adminlte::page')

@section('title', 'Películas')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">
        LISTA DE PELÍCULAS
    </h1>
@stop

@section('content')

<div class="responsive-container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row gap-2 mb-3">

        <a href="{{ route('peliculas.create') }}"
           class="btn btn-primary btn-sm md:btn-md">

            <i class="fas fa-plus"></i> NUEVA PELÍCULA

        </a>

    </div>

    <div class="table-responsive">

        <table id="peliculas"
               class="table table-striped table-bordered table-hover shadow-sm"
               style="width:100%">

            <thead class="bg-primary text-white sticky-top">

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th>Clasificación</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

                @forelse ($peliculas as $pelicula)

                    <tr>

                        <td class="text-center">
                            {{ $pelicula->id }}
                        </td>

                        <td class="text-nowrap">
                            {{ $pelicula->nombre }}
                        </td>

                        <td class="text-center">
                            {{ $pelicula->duracion }} min
                        </td>

                        <td class="text-center">
                            <span class="badge bg-info text-dark">
                                {{ $pelicula->genero->nombre }}
                            </span>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-warning text-dark">
                                {{ $pelicula->clasificacion->nombre }}
                            </span>
                        </td>

                        <td class="text-nowrap">

                            <div class="btn-group btn-group-sm">

                                <a href="{{ route('peliculas.edit', $pelicula->id) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="fas fa-edit"></i>
                                    <span class="d-none d-md-inline">
                                        Editar
                                    </span>

                                </a>

                                <form action="{{ route('peliculas.destroy', $pelicula->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">

                                        <i class="fas fa-trash"></i>

                                        <span class="d-none d-md-inline">
                                            Eliminar
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted py-4">

                            No hay películas registradas.

                            <a href="{{ route('peliculas.create') }}">
                                Crear una ahora
                            </a>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop


@section('css')

<link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"
      rel="stylesheet">

<style>

    .table-responsive {
        -webkit-overflow-scrolling: touch;
    }

    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .responsive-container {
        padding: 0.5rem;
    }

    @media (max-width: 576px) {

        .responsive-container {
            padding: 0;
        }

    }

</style>

@stop


@section('js')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

<script>

    $(document).ready(function() {

        $('#peliculas').DataTable({

            "lengthMenu": [[5, 10, 50, -1],
                           [5, 10, 50, "All"]],

            "responsive": true,

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }

        });

    });

    $(document).on("submit", ".delete-form", function(e) {

        if(!confirm("¿Deseas eliminar esta película?")) {
            e.preventDefault();
        }

    });

</script>

@stop