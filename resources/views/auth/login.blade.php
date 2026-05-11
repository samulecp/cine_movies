<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <style>
        /* ── Bloqueo ── */
        .lockout-message {
            display: none;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #ef4444;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            animation: slideDown 0.4s ease-out;
        }

        .lockout-message.active {
            display: block;
        }

        .lockout-message i.lock-icon {
            font-size: 2rem;
            color: #dc2626;
            margin-bottom: 10px;
            display: block;
            animation: shake 0.6s ease-out;
        }

        .lockout-message h3 {
            color: #991b1b;
            font-size: 1.2rem;
            margin: 10px 0;
            font-weight: 700;
        }

        .lockout-message p {
            color: #7f1d1d;
            font-size: 0.95rem;
            margin: 8px 0;
            line-height: 1.5;
        }

        .countdown-timer {
            font-size: 2.2rem;
            color: #dc2626;
            font-weight: 700;
            margin: 15px auto;
            font-family: 'Courier New', monospace;
            background: rgba(220, 38, 38, 0.1);
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #dc2626;
            letter-spacing: 2px;
            max-width: 140px;
        }

        .countdown-label {
            color: #7f1d1d;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* ── Advertencia (intentos restantes) ── */
        .warning-message {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 16px;
            text-align: center;
            animation: slideDown 0.3s ease-out;
        }

        .warning-message p {
            color: #92400e;
            font-size: 0.9rem;
            margin: 0;
        }

        .warning-message strong {
            color: #78350f;
        }

        /* ── Formulario desactivado ── */
        .login-form.disabled {
            opacity: 0.55;
            pointer-events: none;
            user-select: none;
        }

        /* ── Animaciones ── */
        @keyframes slideDown {
            from { transform: translateY(-16px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }

        @keyframes shake {
            0%,100% { transform: translateX(0)   scale(1);    }
            10%,30%,50%,70%,90% { transform: translateX(-4px) scale(1.06); }
            20%,40%,60%,80%     { transform: translateX( 4px) scale(1.06); }
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .countdown-timer { font-size: 1.8rem; }
            .lockout-message  { padding: 15px; }
            .lockout-message h3 { font-size: 1rem; }
            .lockout-message p  { font-size: 0.88rem; }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <section class="login-panel">
            <div class="brand-block">
                <img src="/img/logofinal.jpeg" alt="Logo Cine" class="logo">
                <h1>Bienvenido a CineMovies</h1>
                <p>Ingresa para administrar funciones, ventas y usuarios.</p>
            </div>

            <!-- ══ Mensaje de bloqueo ══ -->
            <div class="lockout-message" id="lockoutMessage">
                <i class="fas fa-lock lock-icon"></i>
                <h3>Cuenta bloqueada temporalmente</h3>
                <p>Excediste el límite de <strong>3 intentos</strong> fallidos.</p>
                <p>Podrás intentarlo de nuevo en:</p>
                <div class="countdown-timer" id="countdownTimer">5:00</div>
                <span class="countdown-label">Tiempo restante</span>
            </div>

            <!-- ══ Errores de Laravel ══ -->
            @if ($errors->any())
                <div class="login-errors" id="loginErrors">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- ══ Advertencia de intentos (inyectada por JS) ══ -->
            <div id="warningMessage"></div>

            <form method="POST" action="{{ route('login') }}" class="login-form" id="loginForm">
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

                <div class="form-group">
                    <label for="password">Contrasena</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Tu contrasena"
                    >
                </div>

                <div class="form-row">
                    <label for="remember_me" class="remember-wrap">
                        <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="inline-link" href="{{ route('password.request') }}">Olvidaste tu contrasena?</a>
                    @endif
                </div>

                <button type="submit" class="login-btn" id="loginBtn">Entrar</button>
            </form>

            <div class="links">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">No tienes una cuenta? Registrate</a>
                @endif
            </div>
        </section>
    </main>

    <script>
    (function () {
        /* ── Constantes ── */
        const LOCKOUT_KEY      = 'cinemarvel_lockout_until'; // timestamp de expiración
        const ATTEMPTS_KEY     = 'cinemarvel_login_attempts';
        const MAX_ATTEMPTS     = 3;
        const LOCKOUT_MS       = 5 * 60 * 1000; // 5 minutos

        /* ── Helpers de almacenamiento ── */
        function getAttempts()   { return parseInt(localStorage.getItem(ATTEMPTS_KEY) || '0'); }
        function setAttempts(n)  { localStorage.setItem(ATTEMPTS_KEY, n); }

        function getLockoutUntil() {
            const v = localStorage.getItem(LOCKOUT_KEY);
            return v ? parseInt(v) : null;
        }

        function activateLockout() {
            const until = Date.now() + LOCKOUT_MS;
            localStorage.setItem(LOCKOUT_KEY, until);
            setAttempts(MAX_ATTEMPTS);
        }

        function clearLockout() {
            localStorage.removeItem(LOCKOUT_KEY);
            localStorage.removeItem(ATTEMPTS_KEY);
        }

        /* ── Estado del bloqueo ── */
        function isLockedOut() {
            const until = getLockoutUntil();
            if (!until) return false;
            if (Date.now() >= until) {
                clearLockout();
                return false;
            }
            return true;
        }

        /* ── UI: mostrar / ocultar bloqueo ── */
        function showLockout() {
            document.getElementById('lockoutMessage').classList.add('active');
            document.getElementById('loginForm').classList.add('disabled');
            document.getElementById('warningMessage').innerHTML = '';
            startCountdown();
        }

        function hideLockout() {
            document.getElementById('lockoutMessage').classList.remove('active');
            document.getElementById('loginForm').classList.remove('disabled');
        }

        /* ── Contador regresivo ── */
        let countdownInterval = null;

        function startCountdown() {
            // Limpiar cualquier intervalo previo
            if (countdownInterval) clearInterval(countdownInterval);

            function tick() {
                const until = getLockoutUntil();
                if (!until) { hideLockout(); return; }

                const remaining = until - Date.now();

                if (remaining <= 0) {
                    clearInterval(countdownInterval);
                    clearLockout();
                    hideLockout();
                    return;
                }

                const totalSecs = Math.ceil(remaining / 1000);
                const mins = Math.floor(totalSecs / 60);
                const secs = totalSecs % 60;
                document.getElementById('countdownTimer').textContent =
                    `${mins}:${secs.toString().padStart(2, '0')}`;
            }

            tick(); // ejecución inmediata para no esperar 1 seg
            countdownInterval = setInterval(tick, 1000);
        }

        /* ── Advertencia de intentos restantes ── */
        function showAttemptsWarning(remaining) {
            const box = document.getElementById('warningMessage');
            box.innerHTML = `
                <div class="warning-message">
                    <p>
                        <strong>⚠ Advertencia:</strong>
                        Te ${remaining === 1 ? 'queda' : 'quedan'}
                        <strong>${remaining} intento${remaining === 1 ? '' : 's'}</strong>
                        antes de ser bloqueado por 5 minutos.
                    </p>
                </div>`;
        }

        /* ── Lógica principal al cargar la página ── */
        document.addEventListener('DOMContentLoaded', function () {

            // ¿Ya estaba bloqueado antes de cargar?
            if (isLockedOut()) {
                showLockout();
                return; // nada más que hacer
            }

            // ¿Hubo un error de credenciales en este intento?
            const errorsDiv = document.getElementById('loginErrors');
            const hasError  = errorsDiv && errorsDiv.textContent.trim() !== '';

            if (hasError) {
                const attempts = getAttempts() + 1; // contar ESTE intento fallido
                setAttempts(attempts);

                if (attempts >= MAX_ATTEMPTS) {
                    activateLockout();
                    showLockout();
                } else {
                    const remaining = MAX_ATTEMPTS - attempts;
                    showAttemptsWarning(remaining);
                }
            }

            /* ── Bloquear envío del formulario si está bloqueado ── */
            document.getElementById('loginForm').addEventListener('submit', function (e) {
                if (isLockedOut()) {
                    e.preventDefault();
                    showLockout();
                }
            });
        });

    })();
    </script>
</body>
</html>