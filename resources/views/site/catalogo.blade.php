<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <section class="catalogo-api-section">
        <div class="container py-5">

            {{-- TITULO --}}
            <div class="text-center mb-5">
                <p class="catalogo-api-subtitle">DESCUBRE MÁS PRODUCTOS</p>
                <h1 class="catalogo-api-title">Catálogo de Belleza</h1>

                <div class="catalogo-api-text-box">
                    <p>
                        Explora productos externos de belleza integrados desde una API
                        para complementar la experiencia de Velour Beauty.
                    </p>
                </div>
            </div>

            {{-- PRODUCTOS API --}}
            @if(!empty($productosApi))
                <div class="row g-4">
                    @foreach($productosApi as $producto)
                        <div class="col-md-6 col-lg-3">
                            <div class="api-card h-100">

                                <div class="api-card-img-box">
                                    @if($producto['thumbnail'])
                                        <img src="{{ $producto['thumbnail'] }}"
                                            alt="{{ $producto['title'] }}"
                                            class="api-card-img">
                                    @else
                                        <div class="api-no-image">
                                            Sin imagen
                                        </div>
                                    @endif
                                </div>

                                <div class="api-card-body">
                                    <span class="api-badge">
                                        {{ $producto['category'] }}
                                    </span>

                                    <h5 class="api-card-title">
                                        {{ $producto['title'] }}
                                    </h5>

                                    <p class="api-brand">
                                        <strong>Marca:</strong> {{ $producto['brand'] }}
                                    </p>

                                    <p class="api-card-text">
                                        {{ \Illuminate\Support\Str::limit($producto['description'], 90) }}
                                    </p>

                                    <div class="api-card-footer">
                                        <span class="api-price">
                                            ${{ number_format($producto['price'], 2) }}
                                        </span>

                                        @if($producto['rating'])
                                            <span class="api-rating">
                                                ★ {{ $producto['rating'] }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning text-center shadow-sm rounded-4">
                    No se pudieron cargar los productos de la API en este momento.
                </div>
            @endif

        </div>
    </section>

    {{-- MARCAS --}}
    <section class="brands-section bg-white">
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