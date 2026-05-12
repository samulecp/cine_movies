@extends('adminlte::page')

@section('title', 'Registrar Formato')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        REGISTRAR FORMATO
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('formatos.store') }}"
              method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Descripción</label>

                    <input type="text"
                           name="descripcion"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Precio</label>

                    <input type="number"
                           step="0.01"
                           name="precio"
                           class="form-control"
                           required>

                </div>

            </div>

            <button type="submit"
                    class="btn btn-success btn-sm">

                Guardar

            </button>

            <a href="{{ route('formatos.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop