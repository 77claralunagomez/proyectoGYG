<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<!-- Carrousel-->

<section class="container-fluid col-12">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">

        <div class="carousel-inner">
            <!-- Imagenes-->
            <!-- IMAGEN 1-->
            <div class="carousel-item active">
                <a href="#"><img src="assets/img/chicolentes.webp" class="d-block w-100"></a>
            </div>
            <!-- IMAGEN 2-->
            <div class="carousel-item">
                <a href="#"><img src="assets/img/chicalentes.webp" class="d-block w-100"></a>
            </div>
            <!-- IMAGEN 3-->
            <div class="carousel-item">
                <a href="#"><img src="assets/img/lentes.jpg" class="d-block w-100"></a>
            </div>
            <!-- IMAGEN 4-->
            <div class="carousel-item">
                <a href="#"><img src="assets/img/promo.webp" class="d-block w-100"></a>
            </div>
        </div>

        <!--botones para cambiar de imagen-->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!-- Indicadores del carousel-->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0"
                class="active"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="3"></button>
        </div>
    </div>
</section>

<!-- PRODUCTOS DESTACADOS -->
<?php
$productosConStock = array_filter($productos, fn($p) => $p['stock'] > 0);
$chunkedProductos = array_chunk($productosConStock, 4);
?>

<section class="bg-light my-3 py-5 px-5">
    <div class="container text-center">
        <h1>Productos Destacados</h1>
    </div>

    <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php foreach ($chunkedProductos as $i => $grupo): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <div class="row justify-content-center">
                        <?php foreach ($grupo as $producto): ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card h-100">
                                    <img src="<?= base_url($producto['url_imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>">

                                    <div class="card-body">
                                        <h5 class="card-title text-truncate"><?= esc($producto['nombre']) ?></h5>

                                        <div>
                                            <span class="fw-bold text-primary">$<?= number_format($producto['precio'], 2, ',', '.') ?></span>
                                        </div>
                                        <a href="<?= base_url('producto/' . $producto['id_producto']) ?>" class="btn btn-dark btn-sm mt-auto">Ver</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>

<?= $this->endSection(); ?>