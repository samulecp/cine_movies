@extends('adminlte::page') @section('title', 'Registrar Puesto') @section('content_header') <h1
    class="text-sm sm:text-base md:text-lg lg:text-xl font-bold"> REGISTRAR PUESTO </h1> @stop @section('content') <div
    class="card shadow rounded-lg">
    <div class="card-body">
        <form action="{{ route('puestos.store') }}" method="POST"> @csrf <div class="row">
                <div class="col-12 col-md-6 mb-3"> <label>Nombre</label> <input type="text" name="nombre"
                        class="form-control" required> </div>
                
            </div> <button class="btn btn-primary"> Guardar </button> <a href="{{ route('puestos.index') }}"
                class="btn btn-secondary"> Volver </a> </form>
    </div>
</div> @stop
