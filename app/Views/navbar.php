<nav class="navbar fixed-top py-3 navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid d-flex align-items-center">

        <a class="navbar-brand" href="<?= base_url() ?>"><img src="assets/img/svg/icon_eyeglasses.svg"
         width="38" height="38"> G&G Óptica</a>


        <!-- Botón hamburguesa SOLO visible en pantallas chicas -->
        <button class="navbar-toggler d-lg-none ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menú para ESCRITORIO (pantallas grandes) -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="catalogo">Catalogo</a> 
              <a class="nav-link" href="register">registrar</a>  
            <a class="nav-link" href="login">Usuario</a>
                <a class="nav-link" href="contacto">Contacto</a>
                <a class="nav-link" href="comercializacion">Comercializacion</a>
                <a class="nav-link" href="aboutUs">Sobre Nosotros</a>
                <a class="nav-link" href="terminos">Terminos y Condiciones</a>
            </div>
        </div>

    </div>
</nav>

<!-- Menú hamburguesa OFFCANVAS solo en móviles -->
<div class="offcanvas offcanvas-start d-lg-none bg-dark text-light" tabindex="-1" id="offcanvasNavbar"
    aria-labelledby="offcanvasNavbarLabel" data-bs-theme="dark">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
        <img src="assets/img/svg/icon_eyeglasses.svg" width="38" height="38">
            G&G Óptica</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
        <a class="nav-link" href="contacto">Contacto</a>
        <a class="nav-link" href="comercializacion">Comercializacion</a>
        <a class="nav-link" href="aboutUs">Sobre Nosotros</a>
        <a class="nav-link" href="terminos">Terminos y Condiciones</a>
        
    </div>
</div>