@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: @json(session('success')),
                confirmButtonColor: '#d98c9a'
            });
        });
    </script>
@endif

@if(session('updated'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Actualización Exitosa :D',
                text: @json(session('updated')),
                confirmButtonColor: '#d98c9a'
            });
        });
    </script>
@endif

@if(session('deleted'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Eliminado Correctamente!',
                text: @json(session('deleted')),
                confirmButtonColor: '#d98c9a'
            });
        });
    </script>
@endif

@if(session('registro'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso :D',
                text: @json(session('registro')),
                confirmButtonColor: '#d98c9a'
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Acceso Requerido',
                text: 'Debes iniciar sesión para acceder al sistema.',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#b85c74'
            });
        });
    </script>
@endif

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Revisa los campos',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d98c9a'
            });
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const title = form.dataset.title || '¿Eliminar registro?';
                const text = form.dataset.text || 'Esta acción no se puede deshacer.';
                const confirmText = form.dataset.confirm || 'Sí, eliminar';
                const cancelText = form.dataset.cancel || 'Cancelar';

                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: confirmText,
                    cancelButtonText: cancelText,
                    reverseButtons: true,
                    confirmButtonColor: '#b65a67',
                    cancelButtonColor: '#e7c7cf'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>