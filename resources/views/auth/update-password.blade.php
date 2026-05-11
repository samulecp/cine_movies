<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contrasena</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <style>
        .alert-success,
        .alert-error {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-weight: 500;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 400px;
            animation: slideIn 0.3s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-left: 4px solid #047857;
        }

        .alert-error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border-left: 4px solid #b91c1c;
        }

        .alert-success i {
            font-size: 1.2rem;
            animation: popIn 0.5s ease-out;
        }

        .alert-error i {
            font-size: 1.2rem;
            animation: shake 0.5s ease-out;
        }

        .alert-success .close-btn,
        .alert-error .close-btn {
            margin-left: auto;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.3rem;
            padding: 0;
            display: flex;
            align-items: center;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            10%, 30%, 50%, 70%, 90% {
                transform: translateX(-5px);
            }
            20%, 40%, 60%, 80% {
                transform: translateX(5px);
            }
        }

        .alert-hide {
            animation: slideOut 0.3s ease-out forwards;
        }

        @media (max-width: 640px) {
            .alert-success,
            .alert-error {
                max-width: calc(100% - 40px);
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <section class="login-panel">
            <div class="brand-block">
                <img src="/img/logo.png" alt="Logo Cine" class="logo">
                <h1>Cambiar contrasena</h1>
                <p>Actualiza tu contrasena para mantener tu cuenta segura.</p>
            </div>

            @if (session('status'))
                <div class="alert-success" id="successAlert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                    <button type="button" class="close-btn" onclick="closeAlert('successAlert')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if ($errors->updatePassword->any())
                <div class="alert-error" id="errorAlert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach ($errors->updatePassword->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button type="button" class="close-btn" onclick="closeAlert('errorAlert')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('user-password.update') }}" class="login-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Contrasena actual</label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        required
                        autocomplete="current-password"
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

                <button type="submit" class="login-btn">Actualizar contrasena</button>
            </form>

            <div class="links">
                <a href="/">Volver al inicio</a>
            </div>
        </section>
    </main>

    <script>
        // Cerrar alerta manualmente
        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.classList.add('alert-hide');
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }
        }

        // Auto cerrar alertas después de 5 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            if (successAlert) {
                setTimeout(() => {
                    closeAlert('successAlert');
                }, 5000);
            }

            if (errorAlert) {
                setTimeout(() => {
                    closeAlert('errorAlert');
                }, 6000);
            }

            // Validar que las contraseñas coincidan en tiempo real
            const passwordInput = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            if (passwordInput && passwordConfirmation) {
                const validatePasswords = () => {
                    if (passwordInput.value && passwordConfirmation.value) {
                        if (passwordInput.value === passwordConfirmation.value) {
                            passwordConfirmation.style.borderColor = '#10b981';
                        } else {
                            passwordConfirmation.style.borderColor = '#ef4444';
                        }
                    }
                };

                passwordInput.addEventListener('input', validatePasswords);
                passwordConfirmation.addEventListener('input', validatePasswords);
            }

            // Validar contraseña actual
            const currentPasswordInput = document.getElementById('current_password');
            const form = document.querySelector('.login-form');

            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!currentPasswordInput.value) {
                        e.preventDefault();
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'alert-error';
                        errorDiv.id = 'formErrorAlert';
                        errorDiv.innerHTML = `
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Por favor, ingresa tu contraseña actual</span>
                            <button type="button" class="close-btn" onclick="closeAlert('formErrorAlert')">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        document.body.appendChild(errorDiv);
                        setTimeout(() => {
                            closeAlert('formErrorAlert');
                        }, 5000);
                    }
                });
            }
        });
    </script>
</body>
</html>
