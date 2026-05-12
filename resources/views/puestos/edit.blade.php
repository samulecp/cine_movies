@extends('adminlte::page')

@section('title', 'Editar Puesto')

@section('content_header')
    <h1>EDITAR PUESTO</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('puestos.update', $puesto) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-12 col-md-6 mb-3">
                    <label>Nombre</label>

                    <input type="text"
                           name="nombre"
                           class="form-control"
                           value="{{ $puesto->nombre }}"
                           required>
                </div>

                

            </div>

            <button class="btn btn-warning">
                Actualizar
            </button>

            <a href="{{ route('puestos.index') }}"
               class="btn btn-secondary">
                Volver
            </a>

        </form>

    </div>
</div>
@stop