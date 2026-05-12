@extends('adminlte::page')

@section('title', 'Registrar Columna')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        REGISTRAR COLUMNA
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('columnas.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Número</label>

                <input type="number"
                       name="numero"
                       class="form-control"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-success btn-sm">

                Guardar

            </button>

            <a href="{{ route('columnas.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop