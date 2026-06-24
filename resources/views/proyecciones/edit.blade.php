@extends('adminlte::page')

@section('title', 'Editar Proyección')

@section('content_header')
    <h1>EDITAR PROYECCIÓN</h1>
@stop

@section('content')

<div class="card p-3">

    <form action="{{ route('proyecciones.update', $proyeccion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6">
                <label>Película</label>
                <select name="pelicula_id" class="form-control">
                    @foreach($peliculas as $p)
                        <option value="{{ $p->id }}"
                            {{ $proyeccion->pelicula_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label>Sala</label>
                <select name="sala_id" class="form-control">
                    @foreach($salas as $s)
                        <option value="{{ $s->id }}"
                            {{ $proyeccion->sala_id == $s->id ? 'selected' : '' }}>
                            Sala {{ $s->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mt-2">
                <label>Lenguaje</label>
                <select name="lenguaje_id" class="form-control">
                    @foreach($lenguajes as $l)
                        <option value="{{ $l->id }}"
                            {{ $proyeccion->lenguaje_id == $l->id ? 'selected' : '' }}>
                            {{ $l->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mt-2">
                <label>Fecha</label>
                <input type="date" name="fecha"
                       value="{{ $proyeccion->fecha }}"
                       class="form-control">
            </div>

            <div class="col-md-3 mt-2">
                <label>Hora Inicio</label>
                <input type="time" name="horaIni"
                       value="{{ $proyeccion->horaIni }}"
                       class="form-control">
            </div>

        </div>

        <div class="mt-3">
            <button class="btn btn-warning">
                Actualizar
            </button>
        </div>

    </form>

</div>

@stop