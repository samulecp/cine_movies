@extends('adminlte::page')

@section('title', 'Cajeros')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">LISTA DE CAJEROS</h1>
@stop

@section('content')
    <div class="responsive-container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
            <a href="{{ route('cajero.create') }}" class="btn btn-primary btn-sm md:btn-md">
                <i class="fas fa-plus"></i> NUEVO CAJERO
            </a>
        </div>

        <!-- Desktop view: Table -->
        <div class="table-responsive">
            <table id="cajeros" class="table table-striped table-bordered table-hover shadow-sm" style="width:100%">
                <thead class="bg-primary text-white sticky-top">
                    <tr>
                        <th scope="col" class="text-nowrap">ID</th>
                        <th scope="col" class="text-nowrap">Nombre</th>
                        <th scope="col" class="text-nowrap">Puesto</th>
                        <th scope="col" class="text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                    <tr>
                        <td class="text-center">{{ optional($usuario->cajero)->id }}</td>
                        <td class="text-nowrap">{{ $usuario->name }} {{ $usuario->lastname }}</td>
                        <td class="text-center"><span class="badge bg-info text-dark">{{ optional($usuario->cajero->puesto)->nombre ?? 'Sin asignar' }}</span></td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('cajero.edit', $usuario->id) }}" class="btn btn-info btn-sm" title="Editar cajero">
                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span>
                                </a>
                                <form action="{{ route('cajero.destroy', $usuario->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar cajero">
                                        <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No hay cajeros registrados. 
                            <a href="{{ route('cajero.create') }}">Crear uno ahora</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            #cajeros thead {
                font-size: 0.875rem;
            }
            
            #cajeros tbody {
                font-size: 0.8125rem;
            }
            
            .btn-group-sm .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            #cajeros thead {
                font-size: 0.75rem;
            }
            
            #cajeros tbody {
                font-size: 0.75rem;
            }

            .table {
                margin-bottom: 0;
            }

            .btn-group-sm .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.65rem;
            }

            .btn-group-sm .btn-sm i {
                margin-right: 0.2rem;
            }
        }
    </style>

@stop

@section('css')
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
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
        const dataTable = $('#cajeros').DataTable({
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }
        });
    });

    // Confirm delete action
    $(document).on("submit", ".delete-form", function(e) {
        if(!confirm("¿Estás seguro de que deseas eliminar este cajero?")) {
            e.preventDefault();
        }
    });

    // Responsive adjustments
    $(window).on('resize', function() {
        if ($(window).width() <= 768) {
            $('#cajeros').DataTable().columns.adjust();
        }
    });
</script>
@stop
