@extends('adminlte::page')

@section('title', 'Editar Butaca')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">EDITAR BUTACA</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('butacas.update', $butaca->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Sala</label>
                    <select name="sala_id" class="form-control" required>
                        @foreach($salas as $sala)
                            <option value="{{ $sala->id }}"
                                {{ $butaca->sala_id == $sala->id ? 'selected' : '' }}>
                                Sala {{ $sala->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Fila</label>
                    <select name="fila_id" class="form-control" required>
                        @foreach($filas as $fila)
                            <option value="{{ $fila->id }}"
                                {{ $butaca->fila_id == $fila->id ? 'selected' : '' }}>
                                {{ $fila->letra }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Columna</label>
                    <select name="columna_id" class="form-control" required>
                        @foreach($columnas as $columna)
                            <option value="{{ $columna->id }}"
                                {{ $butaca->columna_id == $columna->id ? 'selected' : '' }}>
                                {{ $columna->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control" required>

                        <option value="Disponible"
                            {{ $butaca->estado == 'Disponible' ? 'selected' : '' }}>
                            Disponible
                        </option>

                        <option value="Ocupada"
                            {{ $butaca->estado == 'Ocupada' ? 'selected' : '' }}>
                            Ocupada
                        </option>

                        <option value="Mantenimiento"
                            {{ $butaca->estado == 'Mantenimiento' ? 'selected' : '' }}>
                            Mantenimiento
                        </option>

                    </select>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                Actualizar
            </button>

            <a href="{{ route('butacas.index') }}" class="btn btn-secondary btn-sm">
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop