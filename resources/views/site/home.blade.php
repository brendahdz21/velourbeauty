<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Velour Beauty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <section class="hero">
        <img src="{{ asset('img/Fondo.png') }}" class="hero-bg" alt="Fondo">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <p class="hero-subtitle">DESCUBRE TU BELLEZA</p>
            <h1>Velour Beauty</h1>

            <div class="hero-text-box">
                <p>
                    Explora nuestra nueva colección de maquillaje pensada
                    para resaltar tus facciones naturales.
                </p>
            </div>

            <a href="{{ route('catalogo') }}" class="catalog-btn">Ver Catálogo</a>
        </div>
    </section>

    {{-- MARCAS --}}
    <section class="brands-section">
        <h2>Nuestras Marcas</h2>
        <div class="brands-line"></div>

        @if($marcas->count() > 0)
            <div class="brands-carousel">
                <div class="brands-track">

                    @foreach($marcas as $marca)
                        <div class="brand-card">
                            @if($marca->imagen)
                                <img src="{{ asset('storage/' . $marca->imagen) }}" alt="{{ $marca->nombre }}">
                            @else
                                <span>{{ $marca->nombre }}</span>
                            @endif
                        </div>
                    @endforeach

                    @foreach($marcas as $marca)
                        <div class="brand-card">
                            @if($marca->imagen)
                                <img src="{{ asset('storage/' . $marca->imagen) }}" alt="{{ $marca->nombre }}">
                            @else
                                <span>{{ $marca->nombre }}</span>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        @else
            <div class="brands-empty">
                <p>No hay marcas registradas por el momento.</p>
            </div>
        @endif
    </section>

    @endsection
</body>
</html>