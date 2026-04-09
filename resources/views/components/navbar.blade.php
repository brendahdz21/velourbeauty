<nav class="navbar navbar-expand-lg navbar-velour">
    <div class="container-fluid position-relative">

        <!-- LOGO -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/Logo_Horizontal.png') }}" class="logo">
        </a>

        <!-- BOTÓN RESPONSIVE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ -->
        <div class="collapse navbar-collapse" id="navbarContenido">

            <!-- MENÚ CENTRADO -->
            <ul class="navbar-nav nav-menu-center align-items-center">
                <li class="nav-item">
                    <a class="nav-link nav-cat" href="{{ route('home') }}">
                        <i class="bi bi-house"></i> Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-cat" href="{{ route('conocenos') }}">
                        <i class="bi bi-info-circle"></i> Conócenos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-cat" href="{{ route('catalogo') }}">
                        <i class="bi bi-bag"></i> Catálogo
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-cat" href="#">
                        <i class="bi bi-cart"></i>
                    </a>
                </li>
            </ul>

            <!-- BOTÓN DERECHA -->
            <ul class="navbar-nav ms-auto align-items-center">
                @guest
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-ingresar">
                            <i class="bi bi-person"></i> Ingresar
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="btn btn-outline-dark btn-ingresar dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Hola, {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin-dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> Panel Administrativo
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif

                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-2">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>

    </div>
</nav>