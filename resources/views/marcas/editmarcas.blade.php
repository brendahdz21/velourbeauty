<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Marca</title>
</head>
<body>
    @extends('layouts.admin')

    @section('content')
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
                    <a href="{{ route('admin.usuarios') }}" class="admin-link">
                        <i class="bi bi-people"></i>
                        Gestión de Usuarios
                    </a>

                    <a href="{{ route('maquillajes.index') }}" class="admin-link">
                        <i class="bi bi-bag"></i>
                        Gestión de Maquillajes
                    </a>

                    <a href="{{ route('admin.marcas') }}" class="admin-link active">
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

            <div class="register-header">
                <div>
                    <h1 class="register-title">Editar Marca</h1>
                    <p class="register-subtitle">
                        Aquí puedes actualizar la información de la marca seleccionada.
                    </p>
                </div>

                <a href="{{ route('admin.marcas') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            <div class="register-card">
                <form action="{{ route('admin.marcas.update', $marca->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="register-grid">

                        {{-- NOMBRE --}}
                        <div class="form-group full-width">
                            <label class="form-label">Nombre de la Marca</label>

                            <div class="input-wrapper">
                                <i class="bi bi-tags"></i>

                                <input
                                    type="text"
                                    name="nombre"
                                    value="{{ old('nombre', $marca->nombre) }}"
                                    placeholder="Nombre de la Marca"
                                    required
                                >
                            </div>

                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGEN --}}
                        <div class="form-group full-width">
                            <label class="form-label">Logo / Imagen</label>

                            <div class="input-wrapper file-wrapper">
                                <i class="bi bi-image"></i>

                                <input
                                    type="file"
                                    name="imagen"
                                    id="imagen"
                                    accept="image/*"
                                >
                            </div>

                            @error('imagen')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div
                                class="image-preview-box"
                                id="preview-box"
                                style="{{ $marca->imagen ? 'display:flex;' : 'display:none;' }}"
                            >
                                <img
                                    id="preview-imagen"
                                    src="{{ $marca->imagen ? asset('storage/' . $marca->imagen) : '' }}"
                                    alt="Vista previa"
                                >
                            </div>
                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="form-group full-width">
                            <label class="form-label">Descripción</label>

                            <div class="textarea-wrapper">
                                <i class="bi bi-card-text"></i>

                                <textarea
                                    name="descripcion"
                                    rows="4"
                                    placeholder="Descripción"
                                    required
                                >{{ old('descripcion', $marca->descripcion) }}</textarea>
                            </div>

                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- ESTADO --}}
                        <div class="form-group full-width">
                            <label class="form-label">Estado</label>

                            <div class="input-wrapper">
                                <i class="bi bi-toggle-on"></i>

                                <select name="estado" required>
                                    <option value="1" {{ $marca->estado == 1 ? 'selected' : '' }}>
                                        Activa
                                    </option>

                                    <option value="0" {{ $marca->estado == 0 ? 'selected' : '' }}>
                                        Inactiva
                                    </option>
                                </select>
                            </div>

                            @error('estado')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="register-actions">
                        <a href="{{ route('admin.marcas') }}" class="btn-cancel-register">
                            Cancelar
                        </a>

                        <button type="submit" class="btn-save-register">
                            <i class="bi bi-check-circle"></i>
                            Actualizar Marca
                        </button>
                    </div>

                </form>
            </div>

        </section>
    </div>

    <script>
    document.getElementById('imagen').addEventListener('change', function(event) {

        const file = event.target.files[0];

        const preview = document.getElementById('preview-imagen');

        const previewBox = document.getElementById('preview-box');

        if (file) {

            preview.src = URL.createObjectURL(file);

            previewBox.style.display = 'flex';

        }

    });
    </script>
    @endsection
</body>
</html>