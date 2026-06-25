<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cine Movies</title>

    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        body{
            background-color:#0f172a !important;
        }

        .content-wrapper{
            background-color:#0f172a !important;
            color:white;
        }

        .content{
            color:white;
        }
        .pantalla{
    width: 65%;
    margin: auto;
    padding: 12px;
    border-radius: 50px;
    text-align: center;
    font-weight: bold;
    letter-spacing: 2px;

    /* contraste fuerte con fondo oscuro */
    background: linear-gradient(180deg, #ffffff, #cfd4da);

    color: #111;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    border: 2px solid #adb5bd;
}
        .main-header{
            border-bottom:none;
        }

    </style>
</head>

<body class="hold-transition layout-top-nav" style="background-color:#2c3034;">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-dark">
            <a href="{{ route('cartelera.index') }}" class="navbar-brand">
                <span class="brand-text font-weight-light">
                    Cine Movies
                </span>
            </a>
        </nav>
        
        <div class="content-wrapper" style="margin-left:0 !important;">
            <section class="content pt-3">
                @yield('content')
            </section>
        </div>

    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    @yield('js')

</body>

</html>
