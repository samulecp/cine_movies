<!-- resources/views/layouts/base.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cine Marvel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        header {
            margin-bottom: 40px;
        }

        .logo img {
            max-width: 100px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .nav-item {
            text-decoration: none;
            color: white;
            font-size: 16px;
            padding: 10px;
            background-color: #333;
            border-radius: 5px;
        }

        .nav-item:hover {
            background-color: #555;
        }

        .auth-button {
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            background-color: #333;
            border-radius: 5px;
            margin: 5px;
        }

        .auth-button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .row {
            flex-direction: row;
            gap: 40px;
            padding-right: 20px;
            padding-left: 20px;
        }

        /* Nuevas reglas para separar los campos de los formularios
        .form-group {
            margin-bottom: 20px; /* Espacio más amplio entre cada campo
        }

        .form-group label {
            margin-bottom: 10px; /* Separación entre la etiqueta y el campo *
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
            font-size: 14px;
        }

        .selectpicker {
            width: 100%; /* Asegura que los selectores de selección ocupen todo el espacio */
        }

        .custom-spacing {
            margin-bottom: 40px;
            /* Espacio adicional en campos específicos */
        }

        */
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Header -->
    <header class="mb-5">
        <div class="logo">
            <img src="/img/logo.png" alt="Cine XYZ Logo">
        </div>

        <nav class="navbar" id="menu-principal">
            <button class="menu-toggle">☰</button>
            <ul class="nav-links">
                <li><a href="/" class="nav-item">Inicio</a></li>
                <li><a href="boleteriaVirtual" class="nav-item">Horarios</a></li>
                <li><a href="confiteria" class="nav-item">Confitería</a></li>
                <li>
                    <div class="dropdown">
                        <select id="cityDropdown" class="city-selector">
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="La Paz">La Paz</option>
                            <option value="Cochabamba">Cochabamba</option>
                        </select>
                    </div>
                </li>
            </ul>
        </nav>

        {{-- <script src="{{ asset('scripts/scripts.js') }}"></script> --}}

        <!-- Auth buttons -->
        <div class="auth-buttons">
            @guest
                <a id="login" href="{{ route('login') }}" class="auth-button">Iniciar sesión</a>
                <a id="register" href="{{ route('register') }}" class="auth-button">Registrarse</a>
            @endguest
        </div>

        @auth
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" id="logout"
                        style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                        Cerrar sesión
                    </button>
                </form>
            </li>
        @endauth
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 CineMarvel. Todos los derechos reservados.</p>
    </footer>
    <head>
        <!-- Otros enlaces generales -->
        @yield('css')
    </head>

    <body>
        <!-- Contenido de la vista -->

        @yield('js')
    </body>

</html>
