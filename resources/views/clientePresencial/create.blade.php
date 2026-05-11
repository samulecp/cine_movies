@extends('adminlte::page')

@section('title', 'Crear Cliente Presencial')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">CREAR NUEVO CLIENTE PRESENCIAL</h1>
@stop

@section('content')
<div class="responsive-form-container">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">¡Error!</h4>
            <p>Por favor verifica los siguientes campos:</p>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="/clientePresencial" method="POST" class="needs-validation" novalidate>
        @csrf
        
        <div class="row g-3">
            <!-- Nombre Completo -->
            <div class="col-12">
                <label for="nombre" class="form-label">
                    <span class="text-danger">*</span> Nombre Completo
                </label>
                <input 
                    type="text" 
                    name="nombre" 
                    id="nombre"
                    class="form-control @error('nombre') is-invalid @enderror" 
                    value="{{ old('nombre') }}"
                    required
                    placeholder="Nombre completo del cliente"
                >
                @error('nombre')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Carnet de Identidad -->
            <div class="col-12 col-md-6">
                <label for="ci" class="form-label">
                    <span class="text-danger">*</span> Carnet de Identidad
                </label>
                <input 
                    type="text" 
                    name="ci" 
                    id="ci"
                    class="form-control @error('ci') is-invalid @enderror" 
                    value="{{ old('ci') }}"
                    required
                    placeholder="Ej: 1234567-LP"
                >
                @error('ci')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIT -->
            <div class="col-12 col-md-6">
                <label for="nit" class="form-label">
                    <span class="text-danger">*</span> Número de NIT
                </label>
                <input 
                    type="text" 
                    name="nit" 
                    id="nit"
                    class="form-control @error('nit') is-invalid @enderror" 
                    value="{{ old('nit') }}"
                    required
                    placeholder="Ej: 1234567890"
                >
                @error('nit')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="row g-2 mt-4">
            <div class="col-12 col-sm-auto">
                <a href="/clientePresencial" class="btn btn-secondary w-100 w-sm-auto">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                    <i class="fas fa-save"></i> Guardar Cliente
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .responsive-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 1rem;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 576px) {
        .responsive-form-container {
            padding: 0.5rem;
        }

        .row.g-2 {
            gap: 0.5rem;
        }

        .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .form-control,
        .form-select {
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }

    @media (max-width: 768px) {
        .responsive-form-container {
            max-width: 100%;
        }
    }

    .text-danger {
        color: #dc3545;
    }
</style>

@stop

@section('css')
    <style>
        .needs-validation input:invalid,
        .needs-validation select:invalid {
            border-color: #dc3545;
        }
    </style>
@stop

@section('js')
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
