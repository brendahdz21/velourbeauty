<footer class="footer">

    <div class="footer-column footer-brand">
        <img src="{{ asset('img/Logo Vertical.png') }}" class="footer-logo" alt="Velour Beauty">

        <p>
            Tu belleza, nuestra pasión. Productos de maquillaje pensados
            para resaltar tu estilo con elegancia y autenticidad.
        </p>

        <div class="socials">
            <a href="https://facebook.com" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>

            <a href="https://instagram.com" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="https://youtube.com" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>

            <a href="https://tiktok.com" target="_blank">
                <i class="fab fa-tiktok"></i>
            </a>
        </div>
    </div>


    <div class="footer-column">
        <h4>NAVEGACIÓN</h4>

        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('conocenos') }}">Conócenos</a>
        <a href="{{ route('catalogo') }}">Catálogo</a>

        @guest
            <a href="{{ route('login') }}">Ingresar</a>
        @endguest
    </div>


    <div class="footer-column">
        <h4>CONTACTO</h4>

        <a href="mailto:velourbeauty@gmail.com">velourbeauty@gmail.com</a>
        <a href="tel:+5255507230">+52 5550 7230</a>

        <span class="footer-text">
            Atención en línea para ayudarte cuando lo necesites.
        </span>
    </div>

</footer>


<div class="footer-bottom">
    <p>© 2026 Velour Beauty - Todos los derechos reservados.</p>
</div>