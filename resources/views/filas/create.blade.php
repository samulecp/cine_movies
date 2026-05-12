@extends('adminlte::page')

@section('title', 'Registrar Fila')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        REGISTRAR FILA
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('filas.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Letra</label>

                <input type="text"
                       name="letra"
                       class="form-control"
                       maxlength="2"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-success btn-sm">

                Guardar

            </button>

            <a href="{{ route('filas.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop