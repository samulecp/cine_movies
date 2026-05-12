@extends('adminlte::page')

@section('title', 'Clientes Virtuales')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">LISTA DE CLIENTES VIRTUALES</h1>
@stop

@section('content')
    <div class="responsive-container">
        <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
            <a href="{{ route('clienteVirtual.create') }}" class="btn btn-primary btn-sm md:btn-md">
                <i class="fas fa-plus"></i> NUEVO CLIENTE VIRTUAL
            </a>
        </div>

        <!-- Desktop view: Table -->
        <div class="table-responsive">
            <table id="clientesVirtuales" class="table table-striped table-bordered table-hover shadow-sm" style="width:100%">
                <thead class="bg-primary text-white sticky-top">
                    <tr>
                        <th scope="col" class="text-nowrap">ID</th>
                        <th scope="col" class="text-nowrap">Nombre</th>
                        <th scope="col" class="text-nowrap">Correo</th>
                        <th scope="col" class="text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usu)
                    <tr>
                        <td class="text-center">{{ $usu->id }}</td>
                        <td class="text-nowrap">{{ $usu->name }}</td>
                        <td class="text-break">{{ $usu->email }}</td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('clienteVirtual.edit', $usu->id) }}" class="btn btn-warning btn-sm" title="Editar cliente">

    <i class="fas fa-edit"></i>

    <span class="d-none d-md-inline">
        Editar
    </span>

</a>
                                <form action="{{ route('clienteVirtual.destroy', $usu->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar cliente">
                                        <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No hay clientes virtuales registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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

        @media (max-width: 768px) {
            #clientesVirtuales thead {
                font-size: 0.875rem;
            }
            
            #clientesVirtuales tbody {
                font-size: 0.8125rem;
            }
        }

        @media (max-width: 480px) {
            #clientesVirtuales thead {
                font-size: 0.75rem;
            }
            
            #clientesVirtuales tbody {
                font-size: 0.75rem;
            }

            .table {
                margin-bottom: 0;
            }

            .btn-group-sm .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.65rem;
            }
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
            const dataTable = $('#clientesVirtuales').DataTable({
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });

        // Confirm delete action
        $(document).on("submit", ".delete-form", function(e) {
            if(!confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                e.preventDefault();
            }
        });

        // Responsive adjustments
        $(window).on('resize', function() {
            if ($(window).width() <= 768) {
                $('#clientesVirtuales').DataTable().columns.adjust();
            }
        });
    </script>
@stop
