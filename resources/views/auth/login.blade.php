<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <main class="login-page">
        <div class="login-card">

            <h1 class="login-title">Bienvenid@</h1>

            <div class="login-tabs">
                <a href="{{ route('login') }}" class="tab active">Iniciar Sesión</a>
                <a href="{{ route('register.public') }}" class="tab">Registrarse</a>
            </div>

            <!-- Subtítulo -->
            <p class="login-subtitle">Ingresa tus datos para continuar</p>

            <!-- FORM LOGIN -->
            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-4">
                    <label for="email" class="login-label">CORREO ELECTRÓNICO</label>

                    <input id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="login-input @error('email') is-invalid @enderror"
                        placeholder="tu@correo.com"
                        required
                        autofocus>

                    @error('email')
                        <div class="text-danger mt-2 small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="mb-4">
                    <label for="password" class="login-label">CONTRASEÑA</label>

                    <div class="password-wrapper">
                        <input id="password"
                            type="password"
                            name="password"
                            class="login-input @error('password') is-invalid @enderror"
                            placeholder="Contraseña"
                            required>

                        <!-- Icono ojo -->
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>

                    @error('password')
                        <div class="text-danger mt-2 small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- BOTÓN -->
                <button type="submit" class="login-submit">
                    INICIAR SESIÓN
                </button>

                <!-- REGISTRO -->
                <div class="forgot-box">
                    <span style="color:#6f3b42;">¿No tienes cuenta?</span>
                    <a href="{{ route('register.public') }}" class="forgot-link">
                        Regístrate
                    </a>
                </div>

                <!-- OLVIDÉ CONTRASEÑA -->
                @if (Route::has('password.request'))
                    <div class="forgot-box">
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

            </form>

        </div>
    </main>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.querySelector('.toggle-password i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
    </script>

    @endsection
</body>
</html>