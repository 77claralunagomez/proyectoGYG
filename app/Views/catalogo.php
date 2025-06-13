<?= $this->extend('plantilla'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5 my-5 mt-carousel">
    <div class="mt-5 mt-carousel">.</div>
    <h1 class="mb-4">Lista de Productos</h1>
    <?php if (session()->get('rol') == 1): ?>
        <a href="<?= base_url('agregarproducto') ?>" class="btn btn-success">Agregar</a>
    <?php endif; ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
                <td>Ver</td>
                <?php if (session()->get('rol') == 1): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)) : ?>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td><?= esc($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= esc($producto['cantidad']) ?></td>
                        <td><img src="<?= base_url($producto['url_imagen']) ?>" class="img-thumbnail" alt="Producto"></td>
                        <td>
                            <a href="<?= base_url('producto/' . $producto['id_producto']) ?>" class="btn btn-info btn-sm">
                                Ver
                            </a>
                        </td>
                        <td>

                            <?php if (session()->get('rol') == 1): ?>
                                <a href="<?= base_url('editarproducto/' . $producto['id_producto']) ?>" class="btn btn-warning btn-sm me-2">
                                    Editar
                                </a>

                                <!-- Botón Eliminar -->
                                <button type="button"
                                    class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#eliminaModal"
                                    data-bs-id="<?= $producto['id_producto'] ?>">
                                    Eliminar
                                </button>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3" class="text-center">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
    <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url('eliminarProducto') ?>">
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