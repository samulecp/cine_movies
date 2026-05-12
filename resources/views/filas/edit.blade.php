@extends('adminlte::page')

@section('title', 'Editar Fila')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        EDITAR FILA
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('filas.update', $fila->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Letra</label>

                <input type="text"
                       name="letra"
                       class="form-control"
                       value="{{ $fila->letra }}"
                       maxlength="2"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary btn-sm">

                Actualizar

            </button>

            <a href="{{ route('filas.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop