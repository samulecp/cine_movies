@extends('adminlte::page')

@section('title', 'Trabajadores')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">LISTA DE ADMINISTRADORES</h1>
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
            <a href="{{ route('usuario.create') }}" class="btn btn-primary btn-sm md:btn-md">
                <i class="fas fa-plus"></i> NUEVO ADMINISTRADOR
            </a>
        </div>

        <!-- Desktop view: Table -->
        <div class="table-responsive">
            <table id="usuarios" class="table table-striped table-bordered table-hover shadow-sm" style="width:100%">
                <thead class="bg-primary text-white sticky-top">
                    <tr>
                        <th scope="col" class="text-nowrap">ID</th>
                        <th scope="col" class="text-nowrap">Nombre</th>
                        <th scope="col" class="text-nowrap">Rol</th>
                        <th scope="col" class="text-nowrap">Email</th>
                        <th scope="col" class="text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                    <tr>
                        <td class="text-center">{{ $usuario->id }}</td>
                        <td class="text-nowrap">{{ $usuario->name }} {{ $usuario->lastname }}</td>
                        <td class="text-center"><span class="badge bg-info text-dark">{{ $usuario->role }}</span></td>
                        <td class="text-break">{{ $usuario->email }}</td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="/usuario/{{$usuario->id}}/edit" class="btn btn-info btn-sm" title="Editar usuario">
                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span>
                                </a>
                                <form action="{{route('usuario.destroy', $usuario->id)}}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar usuario">
                                        <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Borrar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No hay administradores registrados. 
                            <a href="{{ route('usuario.create') }}">Crear uno ahora</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            #usuarios thead {
                font-size: 0.875rem;
            }
            
            #usuarios tbody {
                font-size: 0.8125rem;
            }
            
            .btn-group-sm .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            #usuarios thead {
                font-size: 0.75rem;
            }
            
            #usuarios tbody {
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
        const dataTable = $('#usuarios').DataTable({
            "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }
        });

        // Scroll horizontally on mobile
        const tableWrapper = document.querySelector('.table-responsive');
        if (tableWrapper && window.innerWidth <= 768) {
            tableWrapper.addEventListener('scroll', function() {
                const scrollLeft = this.scrollLeft;
                const header = this.querySelector('thead');
                if (header) {
                    header.style.transform = `translateX(${scrollLeft}px)`;
                }
            });
        }
    });

    // Confirm delete action
    $(document).on("submit", ".delete-form", function(e) {
        if(!confirm("¿Estás seguro de que deseas eliminar este trabajador?")) {
            e.preventDefault();
        }
    });

    // Responsive adjustments
    $(window).on('resize', function() {
        if ($(window).width() <= 768) {
            $('#usuarios').DataTable().columns.adjust();
        }
    });
</script>
@stop
