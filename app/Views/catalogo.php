<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5 my-5">
    <h1 class="mb-4">Lista de Productos</h1>

    <?php if (session()->get('rol') == 1): ?>
        <div class="mb-3">
            <a href="<?= base_url('agregarproducto') ?>" class="btn btn-success">Agregar</a>
            <a href="<?= base_url('productos-desactivados') ?>" class="btn btn-warning">Productos desactivados</a>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (!empty($productos)) : ?>
            <?php foreach ($productos as $producto) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 position-relative">
                        <div class="position-relative">
                            <img src="<?= base_url($producto['url_imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre']) ?>" style="height: 200px; object-fit: cover;">

                            <?php if (session()->get('rol') == 1): ?>
                                <div class="position-absolute top-0 end-0 m-2 d-flex gap-1">
                                    <a href="<?= base_url('editarproducto/' . $producto['id_producto']) ?>" class="btn btn-warning btn-sm p-1">
                                        ✎
                                    </a>
                                    <button type="button"
                                        class="btn btn-danger btn-sm p-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#eliminaModal"
                                        data-bs-id="<?= $producto['id_producto'] ?>">
                                        🗑️
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= esc($producto['nombre']) ?></h5>
                            <p class="card-text mb-1">Precio: $<?= number_format($producto['precio'], 2) ?></p>
                            <p class="card-text">Stock: <?= esc($producto['stock']) ?></p>
                            <a href="<?= base_url('producto/' . $producto['id_producto']) ?>" class="btn btn-info btn-sm mt-auto">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center">
                <p>No hay productos disponibles.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('desactivarProducto') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="id_eliminar">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminaModalLabel">Confirmar eliminación</h5>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que querés eliminar este producto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>