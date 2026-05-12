@extends('adminlte::page')

@section('title', 'Editar Columna')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        EDITAR COLUMNA
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('columnas.update', $columna->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Número</label>

                <input type="number"
                       name="numero"
                       class="form-control"
                       value="{{ $columna->numero }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary btn-sm">

                Actualizar

            </button>

            <a href="{{ route('columnas.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop