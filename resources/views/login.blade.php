<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Master - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @vite(['resources/css/login.css'])
</head>
<body>
    <!-- Contenedor para mensajes de alerta -->
    <div class="alert-container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Sección principal con el formulario de inicio de sesión -->
    <main>
        <div class="login-container">
            <div class="formulario">
                <!-- Logo dentro del formulario -->
                <div class="logo-container">
                    <img src="{{ asset('images/LOGORETAIL.png') }}" class="logo" alt="Logo de Retail Master">
                </div>

                <!-- Formulario de login -->
                <form method="post">
                    @csrf
                    <div class="input-container">
                        <label for="username" class="form-label">
                            <i class="bi bi-person-square"></i> Usuario
                        </label>
                        <input type="text" id="username" name="username" class="form-input" required>
                    </div>

                    <div class="input-container">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock-fill"></i> Contraseña
                        </label>
                        <input type="password" id="password" name="password" class="form-input" required>
                    </div>

                    <!-- Enlace para recuperar la contraseña -->
                    <div class="forgot-password">
                        <a href="#" class="forgot-link">
                            ¿Olvidó su contraseña?
                        </a>
                    </div>

                    <button type="submit" class="submit-btn">Iniciar sesión</button>

                </form>
            </div>
        </div>
    </main>
</body>
</html>
