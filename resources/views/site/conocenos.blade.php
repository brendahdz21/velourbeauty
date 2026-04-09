<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conocénos Velour Beauty</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <section class="conocenos-section py-5">
        <div class="container">

            <!-- ENCABEZADO -->
            <div class="text-center mb-5">
                <h1 class="titulo-conocenos">Conócenos</h1>
                <div class="linea-decorativa mx-auto"></div>

                <p class="subtitulo-conocenos mt-4">
                    Descubre la esencia detrás de Velour Beauty, una tienda creada para
                    realzar tu belleza con elegancia, estilo y autenticidad.
                </p>
            </div>


            <!-- QUIÉNES SOMOS -->
            <div class="card-conocenos mb-5">
                <h3>¿Quiénes Somos?</h3>

                <p>
                    En <strong>Velour Beauty</strong> creemos que la belleza va más allá de la apariencia:
                    es confianza, expresión y autenticidad. Somos una tienda en línea dedicada
                    a ofrecer maquillaje de calidad con marcas cuidadosamente seleccionadas
                    para brindar una experiencia única a cada cliente.
                </p>
            </div>


            <!-- MISIÓN Y VISIÓN -->
            <div class="row g-4 mb-5">

                <div class="col-md-6">
                    <div class="card-info h-100">
                        <i class="bi bi-bullseye icono-info"></i>
                        <h4>Misión</h4>

                        <p>
                            Ofrecer productos de maquillaje de calidad en un espacio digital
                            accesible, moderno y confiable, facilitando una experiencia de compra
                            cómoda y satisfactoria.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-info h-100">
                        <i class="bi bi-eye icono-info"></i>
                        <h4>Visión</h4>

                        <p>
                            Posicionarnos como una tienda en línea reconocida por su estilo,
                            variedad y compromiso con la belleza y confianza de nuestros clientes.
                        </p>
                    </div>
                </div>

            </div>


            <!-- VALORES -->
            <div class="text-center mb-4">
                <h3 class="mb-4">Nuestros Valores</h3>
            </div>

            <div class="row g-4 text-center mb-5">

                <div class="col-md-3">
                    <div class="valor-box">
                        <i class="bi bi-gem"></i>
                        <p>Calidad</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="valor-box">
                        <i class="bi bi-shield-check"></i>
                        <p>Confianza</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="valor-box">
                        <i class="bi bi-stars"></i>
                        <p>Elegancia</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="valor-box">
                        <i class="bi bi-heart"></i>
                        <p>Pasión</p>
                    </div>
                </div>

            </div>


            <!-- FRASE FINAL -->
            <div class="frase-final text-center">
                <p>
                    “En Velour Beauty creemos que cada persona merece sentirse
                    hermosa, segura y auténtica en su propia esencia.”
                </p>
            </div>

        </div>
    </section>

    @endsection
</body>
</html>