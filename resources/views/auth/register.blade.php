<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/css/login.css"> <!-- Asegúrate de que este archivo CSS tenga el estilo deseado -->
</head>
<body>
    <main class="login-page">
        <section class="login-panel">
            <div class="brand-block">
                <img src="/img/logofinal.jpeg" alt="Logo" class="logo">
                <h1>Registro Cliente Virtual</h1>
                <p>Crea tu cuenta para acceder al modulo de cliente virtual.</p>
            </div>

            @if ($errors->any())
                <div class="login-errors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

        <form method="POST" action="{{ route('register.store') }}" class="login-form">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required autofocus autocomplete="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="text" id="lastname" name="lastname" required autofocus autocomplete="lastname" value="{{ old('lastname') }}">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required autocomplete="username" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono" required autocomplete="tel" value="{{ old('telefono') }}">
            </div>


            <div class="form-group">
                <label for="carnet">NIT o Carnet</label>
                <input type="text" id="carnet" name="carnet" required autocomplete="off" value="{{ old('carnet') }}">
            </div>




            <div class="form-group">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}"
                    title="Debe tener al menos 8 caracteres e incluir una mayuscula, una minuscula y un numero."
                >
                <small id="password-help">Minimo 8 caracteres con mayuscula, minuscula y numero.</small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            </div>

            <p id="password-error" class="login-errors" style="display: none;"></p>

            <button type="submit" class="login-btn">Registrarse</button>
        </form>
        <div class="links">
            <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión</a>
        </div>
        </section>
    </main>
    <script>
        const form = document.querySelector(".login-form");
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("password-error");

        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/;

        function validatePasswordStrength() {
            const value = passwordInput.value;
            if (!passwordPattern.test(value)) {
                passwordError.textContent = "La contrasena debe tener al menos 8 caracteres e incluir mayuscula, minuscula y numero.";
                passwordError.style.display = "block";
                return false;
            }

            passwordError.textContent = "";
            passwordError.style.display = "none";
            return true;
        }

        passwordInput.addEventListener("input", validatePasswordStrength);
        form.addEventListener("submit", (event) => {
            if (!validatePasswordStrength()) {
                event.preventDefault();
                passwordInput.focus();
            }
        });
    </script>
</body>
</html>
