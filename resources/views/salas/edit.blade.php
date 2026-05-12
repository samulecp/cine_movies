@extends('adminlte::page')

@section('title', 'Editar Sala')

@section('content_header')
    <h1 class="text-lg md:text-xl font-bold">
        EDITAR SALA
    </h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('salas.update', $sala->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Formato</label>

                    <select name="formato_id"
                            class="form-control"
                            required>

                        @foreach($formatos as $formato)

                            <option value="{{ $formato->id }}"
                                {{ $sala->formato_id == $formato->id ? 'selected' : '' }}>

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
                           value="{{ $sala->capacidad }}"
                           required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Estado</label>

                    <select name="estado"
                            class="form-control"
                            required>

                        <option value="1"
                            {{ $sala->estado == 1 ? 'selected' : '' }}>
                            Disponible
                        </option>

                        <option value="0"
                            {{ $sala->estado == 0 ? 'selected' : '' }}>
                            No Disponible
                        </option>

                    </select>
                </div>

            </div>

            <button type="submit"
                    class="btn btn-primary btn-sm">
                Actualizar
            </button>

            <a href="{{ route('salas.index') }}"
               class="btn btn-secondary btn-sm">
                Cancelar
            </a>

        </form>

    </div>
</div>

@stop