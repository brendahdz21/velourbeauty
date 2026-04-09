<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    @extends($modoAdmin ? 'layouts.admin' : 'layouts.app')

    @section('content')

    @if($modoAdmin)
        <div class="admin-panel">

            {{-- SIDEBAR --}}
            <aside class="admin-sidebar">
                <div>
                    <div class="admin-user-box">
                        <div class="admin-user-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <p class="admin-greeting">Hola,</p>
                        <h2 class="admin-name">{{ auth()->user()->name }}</h2>
                    </div>

                    <nav class="admin-menu">
                        <a href="{{ route('admin.usuarios') }}" class="admin-link active">
                            <i class="bi bi-people"></i>
                            Gestión de Usuarios
                        </a>

                        <a href="{{ route('maquillajes.index') }}" class="admin-link">
                            <i class="bi bi-bag"></i>
                            Gestión de Maquillajes
                        </a>

                        <a href="{{ route('admin.marcas') }}" class="admin-link">
                            <i class="bi bi-tags"></i>
                            Gestión de Marcas
                        </a>
                    </nav>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="admin-logout-form">
                    @csrf
                    <button type="submit" class="admin-logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </aside>

            {{-- CONTENIDO --}}
            <section class="admin-content">

                <div class="admin-form-wrapper">

                    {{-- HEADER --}}
                    <div class="admin-form-header">
                        <div>
                            <h1 class="admin-title">Registrar Usuario</h1>
                            <p class="admin-subtitle">
                                Aquí puedes registrar nuevos clientes o administradores.
                            </p>
                        </div>

                        <a href="{{ route('admin.usuarios') }}" class="admin-back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Volver
                        </a>
                    </div>

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="admin-alert admin-alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                <strong>Corrige los siguientes errores:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <div class="admin-form-card">
                        <form method="POST" action="{{ route('admin.usuarios.store') }}" class="admin-user-form">
                            @csrf

                            <div class="admin-form-grid">

                                {{-- NOMBRE --}}
                                <div class="admin-field">
                                    <label>Nombre</label>
                                    <div class="admin-input-icon">
                                        <i class="bi bi-person"></i>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
                                    </div>
                                </div>

                                {{-- EMAIL --}}
                                <div class="admin-field">
                                    <label>Correo Electrónico</label>
                                    <div class="admin-input-icon">
                                        <i class="bi bi-envelope"></i>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
                                    </div>
                                </div>

                                {{-- TELÉFONO --}}
                                <div class="admin-field">
                                    <label>Teléfono</label>
                                    <div class="admin-input-icon">
                                        <i class="bi bi-telephone"></i>
                                        <input type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                                    </div> 
                                </div>

                                {{-- PASSWORD --}}
                                <div class="admin-field">
                                    <label>Contraseña</label>
                                    <div class="admin-input-icon password-field">
                                        <i class="bi bi-lock"></i>
                                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                                        <i class="bi bi-eye toggle-password" data-target="password"></i>
                                    </div>
                                </div>

                                {{-- CONFIRM PASSWORD --}}
                                <div class="admin-field admin-field-full">
                                    <label>Confirmar contraseña</label>
                                    <div class="admin-input-icon password-field">
                                        <i class="bi bi-shield-lock"></i>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                                        <i class="bi bi-eye toggle-password" data-target="password_confirmation"></i>
                                    </div>
                                </div>

                            </div>

                            {{-- CHECK ADMIN --}}
                            @if(auth()->user()->is_admin)
                                <div class="admin-role-box">
                                    <label class="admin-checkbox">
                                        <input type="checkbox" name="is_admin" value="1">
                                        <span>Registrar como administrador</span>
                                    </label>
                                    <small>Si no marcas esto, será cliente.</small>
                                </div>
                            @endif

                            {{-- BOTONES --}}
                            <div class="admin-form-actions">
                                <a href="{{ route('admin.usuarios') }}" class="admin-cancel-btn">
                                    Cancelar
                                </a>

                                <button type="submit" class="admin-save-btn">
                                    <i class="bi bi-check-circle"></i>
                                    Guardar Usuario
                                </button>
                            </div>

                        </form>
                    </div>

                </div>

            </section>
        </div>
    @else
        <main class="login-page">
            <div class="login-card" style="max-width: 820px; margin: 40px auto;">

                <h1 class="login-title">Crear Cuenta</h1>

                <div class="login-tabs">
                    <a href="{{ route('login') }}" class="tab">Iniciar Sesión</a>
                    <a href="{{ route('register.public') }}" class="tab active">Registrarse</a>
                </div>

                <p class="login-subtitle">Completa tus datos para registrarte como cliente</p>

                @if ($errors->any())
                    <div class="admin-alert admin-alert-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            <strong>Corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="admin-form-card">
                    <form method="POST" action="{{ route('register.public.store') }}" class="admin-user-form">
                        @csrf

                        <div class="admin-form-grid">

                            {{-- NOMBRE --}}
                            <div class="admin-field">
                                <label>Nombre</label>
                                <div class="admin-input-icon">
                                    <i class="bi bi-person"></i>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
                                </div>
                            </div>

                            {{-- EMAIL --}}
                            <div class="admin-field">
                                <label>Correo Electrónico</label>
                                <div class="admin-input-icon">
                                    <i class="bi bi-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>
                                </div>
                            </div>

                            {{-- TELÉFONO --}}
                            <div class="admin-field">
                                <label>Teléfono</label>
                                <div class="admin-input-icon">
                                    <i class="bi bi-telephone"></i>
                                    <input type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                                </div> 
                            </div>

                            {{-- PASSWORD --}}
                            <div class="admin-field">
                                <label>Contraseña</label>
                                <div class="admin-input-icon password-field">
                                    <i class="bi bi-lock"></i>
                                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                                    <i class="bi bi-eye toggle-password" data-target="password"></i>
                                </div>
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="admin-field admin-field-full">
                                <label>Confirmar contraseña</label>
                                <div class="admin-input-icon password-field">
                                    <i class="bi bi-shield-lock"></i>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                                    <i class="bi bi-eye toggle-password" data-target="password_confirmation"></i>
                                </div>
                            </div>

                        </div>

                        {{-- BOTONES --}}
                        <div class="admin-form-actions">
                            <a href="{{ route('login') }}" class="admin-cancel-btn">
                                Ya tengo cuenta
                            </a>

                            <button type="submit" class="admin-save-btn">
                                <i class="bi bi-check-circle"></i>
                                Registrarme
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>
    @endif

    {{-- SCRIPT OJITO --}}
    <script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);

            if (input.type === "password") {
                input.type = "text";
                this.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = "password";
                this.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });
    </script>

    @endsection
</body>
</html>