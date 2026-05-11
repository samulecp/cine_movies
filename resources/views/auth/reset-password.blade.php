<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contrasena</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <main class="login-page">
        <section class="login-panel">
            <div class="brand-block">
                <img src="/img/logo.png" alt="Logo Cine" class="logo">
                <h1>Restablecer contrasena</h1>
                <p>Elige una contrasena segura para tu cuenta.</p>
            </div>

            @if ($errors->any())
                <div class="login-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email">Correo electronico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Nueva contrasena</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}"
                        title="Debe tener al menos 8 caracteres e incluir una mayuscula, una minuscula y un numero."
                    >
                    <small>Minimo 8 caracteres con mayuscula, minuscula y numero.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar contrasena</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="login-btn">Restablecer contrasena</button>
            </form>

            <div class="links">
                <a href="{{ route('login') }}">Volver a iniciar sesion</a>
            </div>
        </section>
    </main>
</body>
</html>
