<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador - Usuarios</title>
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

            {{-- HEADER --}}
            <div class="admin-header">
                <div>
                    <h1 class="admin-title">Gestión de Usuarios</h1>
                    <p class="admin-subtitle">
                        Administra los usuarios registrados dentro del sistema.
                    </p>
                </div>

                <a href="{{ route('admin.usuarios.create') }}" class="admin-add-btn">
                    <i class="bi bi-plus-circle"></i>
                    Agregar Usuario
                </a>
            </div>

            {{-- BUSCADOR + FILTRO --}}
            <form method="GET" action="{{ route('admin.usuarios') }}" class="admin-filters-row">

                {{-- BUSCADOR --}}
                <div class="admin-search-form">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar por nombre..."
                        value="{{ request('search') }}"
                        onkeyup="clearTimeout(this.delay); this.delay = setTimeout(() => this.form.submit(), 500)"
                    >
                </div>

                {{-- FILTRO --}}
                <div class="admin-filter-box" style="position: relative;">
                    <i class="bi bi-funnel"></i>
                    <select name="tipo" onchange="this.form.submit()">
                        <option value="">Todos</option>
                        <option value="admin" {{ request('tipo') == 'admin' ? 'selected' : '' }}>
                            Administradores
                        </option>
                        <option value="cliente" {{ request('tipo') == 'cliente' ? 'selected' : '' }}>
                            Clientes
                        </option>
                    </select>
                </div>

            </form>

            {{-- TABLA --}}
            <div class="admin-table-box">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Tipo de usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->phone ?? '—' }}</td>

                                <td>
                                    @if($usuario->is_admin)
                                        <span class="user-badge user-badge-admin">
                                            <i class="bi bi-shield-lock"></i>
                                            Admin
                                        </span>
                                    @else
                                        <span class="user-badge user-badge-client">
                                            <i class="bi bi-person"></i>
                                            Cliente
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="admin-actions">

                                        {{-- EDITAR --}}
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn-edit" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form
                                            action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                            method="POST"
                                            class="delete-form"
                                            data-title="¿Eliminar usuario?"
                                            data-text="Esta acción no se puede deshacer."
                                            data-confirm="Sí, eliminar"
                                            data-cancel="Cancelar"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-people" style="font-size: 2rem; color: #c18a95;"></i>
                                        <p style="margin-top:10px;">No se encontraron usuarios.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </section>
    </div>
    @endsection
</body>
</html>