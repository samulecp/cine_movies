@extends('adminlte::page')

@section('title', 'Detalle Proyección')

@section('content_header')
    <h1>DETALLE DE PROYECCIÓN</h1>
@stop

@section('content')

<div class="card p-3">

    <h4>{{ $proyeccion->pelicula->nombre }}</h4>

    <p><strong>Sala:</strong> {{ $proyeccion->sala->id }}</p>

    <p><strong>Fecha:</strong> {{ $proyeccion->fecha }}</p>

    <p><strong>Hora:</strong> {{ $proyeccion->horaIni }} - {{ $proyeccion->horaFin }}</p>

    <p><strong>Lenguaje:</strong> {{ $proyeccion->lenguaje->nombre }}</p>

    <a href="{{ url('/proyeccion/'.$proyeccion->id.'/asientos') }}"
       class="btn btn-success">
        Ver Asientos
    </a>

</div>

@stop