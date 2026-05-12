@extends('adminlte::page')

@section('title', 'Registrar Sala')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        REGISTRAR SALA
    </h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('salas.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Formato</label>

                    <select name="formato_id" class="form-control" required>
                        <option value="">Seleccione</option>

                        @foreach($formatos as $formato)
                            <option value="{{ $formato->id }}">
                                {{ $formato->descripcion }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Capacidad</label>

                    <input type="number"
                           name="capacidad"
                           class="form-control"
                           required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Estado</label>

                    <select name="estado" class="form-control" required>
                        <option value="1">Disponible</option>
                        <option value="0">No Disponible</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-success btn-sm">
                Guardar
            </button>

            <a href="{{ route('salas.index') }}"
               class="btn btn-secondary btn-sm">
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop