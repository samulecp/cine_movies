@extends('adminlte::page') @section('title', 'Puestos') @section('content_header') <h1
    class="text-sm sm:text-base md:text-lg lg:text-xl font-bold"> GESTIÓN DE PUESTOS </h1> @stop @section('content') <div
    class="card shadow rounded-lg">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2"> <a
            href="{{ route('puestos.create') }}" class="btn btn-primary btn-sm"> Nuevo Puesto </a> </div>
    <div class="card-body table-responsive">
        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
            @endif <table class="table table-bordered table-striped text-nowrap">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        
                        <th width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($puestos as $puesto)
                        <tr>
                            <td>{{ $puesto->id }}</td>
                            <td>{{ $puesto->nombre }}</td>
                            
                           
                            <td>
                                <div class="d-flex flex-wrap gap-1"> <a href="{{ route('puestos.edit', $puesto) }}"
                                        class="btn btn-warning btn-sm"> Editar </a>
                                    <form action="{{ route('puestos.destroy', $puesto) }}" method="POST"> @csrf
                                        @method('DELETE') <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar puesto?')"> Eliminar </button> </form>
                                </div>
                            </td>
                    </tr> @empty <tr>
                            <td colspan="5" class="text-center"> No hay registros </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
</div> @stop
