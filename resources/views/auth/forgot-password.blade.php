<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contrasena</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <main class="login-page">
        <section class="login-panel">
            <div class="brand-block">
                <img src="/img/logofinal.jpeg" alt="Logo Cine" class="logo">
                <h1>Recupera tu contrasena</h1>
                <p>Te enviaremos un enlace para restablecerla.</p>
            </div>

            @if (session('status'))
                <div class="login-errors">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="login-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email">Correo electronico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="ejemplo@cine.com"
                    >
                </div>

                <button type="submit" class="login-btn">Enviar enlace</button>
            </form>

            <div class="links">
                <a href="{{ route('login') }}">Volver a iniciar sesion</a>
            </div>
        </section>
    </main>
</body>
</html>
