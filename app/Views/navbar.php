<nav class="navbar fixed-top py-3 navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid d-flex align-items-center">

        <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assets/img/svg/icon_eyeglasses.svg') ?>"
                width="38" height="38"> G&G Óptica</a>

        <?php if (session()->get('logged_in')): ?>
            <p class="text-light">Bienvenido, <?= session()->get('nombre') ?></p>
        <?php endif; ?>


        <!-- Botón hamburguesa SOLO visible en pantallas chicas -->
        <button class="navbar-toggler d-lg-none ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menú para ESCRITORIO (pantallas grandes) -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">

                <a class="nav-link" href="<?= base_url('catalogo') ?>">Catálogo</a>
                <a class="nav-link" href="<?= base_url('contacto') ?>">Contacto</a>
                <a class="nav-link" href="<?= base_url('comercializacion') ?>">Comercialización</a>
                <a class="nav-link" href="<?= base_url('aboutUs') ?>">Sobre Nosotros</a>
                <a class="nav-link" href="<?= base_url('terminos') ?>">Términos</a>
                <a class="navbar-brand" href="<?= base_url('carrito') ?>">
                    <img src="<?= base_url('assets/img/svg/icon_cart.svg') ?>" width="38" height="38">
                </a>

                <!-- Si la sesion ESTA iniciada, se DESABILITAN estas opciones -->
                <?php if (!session()->get('logged_in')): ?>
                    <a class="nav-link" href="<?= base_url('registrar') ?>">Registrarse</a>
                    <a class="nav-link" href="<?= base_url('iniciarsesion') ?>">Iniciar Sesión</a>
                <?php endif; ?>
                <!-- Si la sesion ESTA iniciada, se HABILITAN estas opciones -->
                <?php if (session()->get('logged_in') == true): ?>
                    <a class="btn btn-primary ms-2" href="<?= base_url('cerrarSesion') ?>">Cerrar sesión</a>
                <?php endif; ?>
            </div>

        </div>

    </div>
</nav>

<!-- Menú hamburguesa OFFCANVAS solo en móviles -->
<div class="offcanvas offcanvas-start d-lg-none bg-dark text-light" tabindex="-1" id="offcanvasNavbar"
    aria-labelledby="offcanvasNavbarLabel" data-bs-theme="dark">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            <img src="<?= base_url('assets/img/svg/icon_eyeglasses.svg'); ?>" width="38" height="38">
            G&G Óptica
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
        <a class="nav-link" href="<?= base_url('catalogo') ?>">Catálogo</a>
        <a class="nav-link" href="<?= base_url('contacto') ?>">Contacto</a>
        <a class="nav-link" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        <a class="nav-link" href="<?= base_url('aboutUs') ?>">Sobre Nosotros</a>
        <a class="nav-link" href="<?= base_url('terminos') ?>">Términos</a>

        <a class="navbar-brand" href="<?= base_url('carrito') ?>">
            <img src="<?= base_url('assets/img/svg/icon_cart.svg') ?>" width="38" height="38">
        </a>

        <?php $loggedIn = session()->get('logged_in'); ?>
        <?php if (!$loggedIn): ?>
            <a class="nav-link" href="<?= base_url('registrar') ?>">Registrarse</a>
            <a class="nav-link" href="<?= base_url('iniciarsesion') ?>">Iniciar Sesión</a>
        <?php else: ?>
            <a class="btn btn-primary ms-2" href="<?= base_url('cerrarSesion') ?>">Cerrar sesión</a>
        <?php endif; ?>

    </div>
</div>