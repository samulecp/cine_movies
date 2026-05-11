@extends('adminlte::page')

@section('title', 'Bitacora')

@section('content_header')
    <h1 class="m-0 text-sm sm:text-base md:text-lg lg:text-xl">Bitácora de Accesos</h1>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            <h5 class="mb-0">Registro de Actividad del Sistema</h5>
        </div>
        <div class="card-body table-responsive p-0" style="-webkit-overflow-scrolling: touch;">
            <table class="table table-striped table-hover table-sm mb-0" id="bitacoraTable">
                <thead class="bg-light">
                    <tr>
                        <th class="text-nowrap">Fecha y Hora</th>
                        <th class="text-nowrap">Usuario</th>
                        <th class="text-nowrap">Acción</th>
                        <th class="d-none d-md-table-cell">Descripción</th>
                        <th class="d-none d-lg-table-cell text-nowrap">IP</th>
                        <th class="d-none d-lg-table-cell text-nowrap">Dispositivo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bitacoras as $bitacora)
                        <tr>
                            <td class="text-nowrap" data-label="Fecha/Hora">
                                <small class="d-block text-muted">{{ $bitacora->fecha_hora }}</small>
                            </td>
                            <td class="text-nowrap" data-label="Usuario">
                                @if ($bitacora->user)
                                    <span class="badge bg-info">{{ $bitacora->user->name }}</span>
                                @else
                                    <span class="badge bg-secondary">Eliminado</span>
                                @endif
                            </td>
                            <td data-label="Acción">
                                <span class="badge bg-warning text-dark">{{ $bitacora->accion }}</span>
                            </td>
                            <td class="d-none d-md-table-cell" data-label="Descripción">
                                <small>{{ Str::limit($bitacora->descripcion, 50) }}</small>
                            </td>
                            <td class="d-none d-lg-table-cell text-nowrap" data-label="IP">
                                <small class="font-monospace">{{ $bitacora->ip_address }}</small>
                            </td>
                            <td class="d-none d-lg-table-cell text-nowrap" data-label="Dispositivo">
                                <small>{{ Str::limit($bitacora->device_info, 30) }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay registros en la bitácora.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">Total de registros: {{ $bitacoras->total() }}</small>
                <nav aria-label="Paginación">
                    {{ $bitacoras->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 8px;
        }

        .table-responsive {
            border-radius: 0 0 8px 8px;
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                border: 1px solid #dee2e6;
                margin-bottom: 1rem;
                border-radius: 4px;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 0.75rem;
                border: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 1rem;
                min-width: 100px;
                color: #495057;
            }
        }

        @media (max-width: 480px) {
            .table tbody td {
                padding: 0.5rem 0.25rem;
                font-size: 0.8rem;
            }

            .badge {
                font-size: 0.7rem;
                padding: 0.3rem 0.5rem;
            }
        }

        .card-header {
            border-bottom: 1px solid #dee2e6;
        }

        .card-footer {
            border-top: 1px solid #dee2e6;
        }
    </style>
@stop
