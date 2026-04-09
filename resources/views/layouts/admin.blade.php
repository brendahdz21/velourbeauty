<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador | Velour Beauty</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite([
        'resources/css/home.css',
        'resources/css/admin.css',
        'resources/css/marcas.css',
        'resources/css/maquillajes.css'
    ])
</head>
<body class="admin-body">
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('partials.alerts')
</body>
</html>