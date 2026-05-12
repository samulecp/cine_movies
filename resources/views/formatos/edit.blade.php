@extends('adminlte::page')

@section('title', 'Editar Formato')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        EDITAR FORMATO
    </h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('formatos.update', $formato->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Descripción</label>

                    <input type="text"
                           name="descripcion"
                           class="form-control"
                           value="{{ $formato->descripcion }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Precio</label>

                    <input type="number"
                           step="0.01"
                           name="precio"
                           class="form-control"
                           value="{{ $formato->precio }}"
                           required>

                </div>

            </div>

            <button type="submit"
                    class="btn btn-primary btn-sm">

                Actualizar

            </button>

            <a href="{{ route('formatos.index') }}"
               class="btn btn-secondary btn-sm">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop