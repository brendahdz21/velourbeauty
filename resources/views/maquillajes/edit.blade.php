<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Maquillaje</title>
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

                    <a href="{{ route('maquillajes.index') }}" class="admin-link active">
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

            <div class="register-header">
                <div>
                    <h1 class="register-title">Editar Maquillaje</h1>
                    <p class="register-subtitle">
                        Aquí puedes actualizar la información del maquillaje seleccionado.
                    </p>
                </div>

                <a href="{{ route('maquillajes.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Volver
                </a>
            </div>

            <div class="register-card">
                <form action="{{ route('maquillajes.update', $maquillaje->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <div class="register-grid">

                        {{-- NOMBRE --}}
                        <div class="form-group">
                            <label class="form-label">Nombre</label>

                            <div class="input-wrapper">
                                <i class="bi bi-bag"></i>

                                <input
                                    type="text"
                                    name="nombre"
                                    value="{{ old('nombre', $maquillaje->nombre) }}"
                                    placeholder="Nombre del Maquillaje"
                                    required
                                >
                            </div>

                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- MARCA --}}
                        <div class="form-group">
                            <label class="form-label">Marca</label>

                            <div class="input-wrapper">
                                <i class="bi bi-tags"></i>

                                <select name="marca_id" required>
                                    <option value="">Selecciona una marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ old('marca_id', $maquillaje->marca_id) == $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('marca_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- PRECIO --}}
                        <div class="form-group">
                            <label class="form-label">Precio</label>

                            <div class="input-wrapper">
                                <i class="bi bi-cash-coin"></i>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    name="precio"
                                    value="{{ old('precio', $maquillaje->precio) }}"
                                    placeholder="Precio"
                                    required
                                >
                            </div>

                            @error('precio')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- STOCK --}}
                        <div class="form-group">
                            <label class="form-label">Stock</label>

                            <div class="input-wrapper">
                                <i class="bi bi-box-seam"></i>

                                <input
                                    type="number"
                                    min="0"
                                    name="stock"
                                    value="{{ old('stock', $maquillaje->stock) }}"
                                    placeholder="Stock"
                                    required
                                >
                            </div>

                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGEN --}}
                        <div class="form-group full-width">
                            <label class="form-label">Imagen</label>

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
                                style="{{ $maquillaje->imagen ? 'display:flex;' : 'display:none;' }}"
                            >
                                <img
                                    id="preview-imagen"
                                    src="{{ $maquillaje->imagen ? asset('storage/' . $maquillaje->imagen) : '' }}"
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
                                >{{ old('descripcion', $maquillaje->descripcion) }}</textarea>
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
                                    <option value="1" {{ old('estado', $maquillaje->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado', $maquillaje->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            @error('estado')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="register-actions">
                        <a href="{{ route('maquillajes.index') }}" class="btn-cancel-register">
                            Cancelar
                        </a>

                        <button type="submit" class="btn-save-register">
                            <i class="bi bi-check-circle"></i>
                            Actualizar Maquillaje
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