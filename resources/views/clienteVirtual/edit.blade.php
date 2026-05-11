@extends('adminlte::page')

@section('title', 'Editar Cliente Virtual')

@section('content_header')
    <h1 class="text-sm sm:text-base md:text-lg lg:text-xl">EDITAR DATOS DEL CLIENTE VIRTUAL</h1>
@stop

@section('content')
<div class="responsive-form-container">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">¡Error!</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="/clienteVirtual/{{ $usuario->id }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        
        <div class="row g-3">
            <!-- Nombre Completo -->
            <div class="col-12">
                <label for="name" class="form-label">
                    <span class="text-danger">*</span> Nombre Completo
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $usuario->name) }}"
                    required
                >
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Apellidos -->
            <div class="col-12">
                <label for="lastname" class="form-label">
                    <span class="text-danger">*</span> Apellidos
                </label>
                <input
                    type="text"
                    name="lastname"
                    id="lastname"
                    class="form-control @error('lastname') is-invalid @enderror"
                    value="{{ old('lastname', $usuario->lastname) }}"
                    required
                >
                @error('lastname')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-12">
                <label for="email" class="form-label">
                    <span class="text-danger">*</span> Correo Electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email', $usuario->email) }}"
                    required
                >
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Telefono -->
            <div class="col-12 col-md-6">
                <label for="telefono" class="form-label">
                    <span class="text-danger">*</span> Telefono
                </label>
                <input
                    type="text"
                    name="telefono"
                    id="telefono"
                    class="form-control @error('telefono') is-invalid @enderror"
                    value="{{ old('telefono', $usuario->clienteVirtual->telefono ?? '') }}"
                    required
                >
                @error('telefono')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Carnet -->
            <div class="col-12 col-md-6">
                <label for="carnet" class="form-label">
                    <span class="text-danger">*</span> Carnet
                </label>
                <input
                    type="text"
                    name="carnet"
                    id="carnet"
                    class="form-control @error('carnet') is-invalid @enderror"
                    value="{{ old('carnet', $usuario->clienteVirtual->carnet ?? '') }}"
                    required
                >
                @error('carnet')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña (opcional en edición) -->
            <div class="col-12">
                <label for="password" class="form-label">
                    Contraseña (dejar en blanco para mantener la actual)
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Nueva contraseña"
                >
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="password_confirmation" class="form-label">
                    Confirmar nueva contraseña
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="Repite la nueva contraseña"
                >
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="row g-2 mt-4">
            <div class="col-12 col-sm-auto">
                <a href="/clienteVirtual" class="btn btn-secondary w-100 w-sm-auto">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
            <div class="col-12 col-sm-auto ms-sm-auto">
                <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                    <i class="fas fa-save"></i> Guardar Cambios
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

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    @media (max-width: 576px) {
        .responsive-form-container {
            padding: 0.5rem;
        }

        .form-control {
            font-size: 16px;
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
        .needs-validation input:invalid {
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
