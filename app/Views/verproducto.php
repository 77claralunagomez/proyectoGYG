<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<div class="container my-5 mt-5 mt-carousel">
    <div class="my-5">.</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <?= session('errors') ?>
                </div>
            <?php endif; ?>


            <div class="card shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="<?= base_url($producto['url_imagen']) ?>" class="img-fluid rounded-start" alt="<?= esc($producto['nombre']) ?>">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h3 class="card-title"><?= esc($producto['nombre']) ?></h3>
                            <p class="card-text"><?= esc($producto['descripcion']) ?></p>
                            <h4 class="text-primary">$<?= number_format($producto['precio'], 2) ?></h4>

                            <p class="card-text"><small class="text-muted">Stock: <?= esc($producto['cantidad']) ?> disponibles</small></p>

                            <form action="<?= base_url('agregarAlCarrito/' . $producto['id_producto']) ?>" method="post" class="mt-3">
                                <?= csrf_field() ?>
                                <div class="input-group mb-3" style="max-width: 150px;">
                                    <input type="number" name="cantidad" value="1" min="1" max="<?= $producto['cantidad'] ?>" class="form-control">
                                    <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar al carrito</button>
                                    <button type="submit" name="accion" value="comprar" class="btn btn-danger">Comprar Ahora</button>

                                </div>
                            </form>

                            <a href="<?= base_url('catalogo') ?>" class="btn btn-outline-secondary mt-2">← Volver a la tienda</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>