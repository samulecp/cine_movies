@extends('adminlte::page')

@section('title', 'Registrar Butaca')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">REGISTRAR BUTACA</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('butacas.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Sala</label>
                    <select name="sala_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($salas as $sala)
                            <option value="{{ $sala->id }}">
                                Sala {{ $sala->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Fila</label>
                    <select name="fila_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($filas as $fila)
                            <option value="{{ $fila->id }}">
                                {{ $fila->letra }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Columna</label>
                    <select name="columna_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($columnas as $columna)
                            <option value="{{ $columna->id }}">
                                {{ $columna->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="Disponible">Disponible</option>
                        <option value="Ocupada">Ocupada</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-success btn-sm">
                Guardar
            </button>

            <a href="{{ route('butacas.index') }}" class="btn btn-secondary btn-sm">
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop