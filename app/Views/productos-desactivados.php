<?= $this->extend('plantilla') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4">Productos Desactivados</h2>

    <?php if (!empty($productos)): ?>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr class="text-center">
                        <td>
                            <img src="<?= base_url($producto['url_imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td><?= esc($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= esc($producto['stock']) ?></td>
                        <td><?= esc($producto['categoria']) ?></td>
                        <td>
                            <form action="<?= base_url('activarProducto') ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= esc($producto['id_producto']) ?>">
                                <button type="submit" class="btn btn-success btn-sm">Activar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No hay productos desactivados.</div>
    <?php endif; ?>

    <a href="<?= base_url('catalogo') ?>" class="btn btn-outline-secondary mt-4">← Volver al catálogo</a>
</div>

<?= $this->endSection() ?>
