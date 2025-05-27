<div class="container mt-5 my-5 mt-carousel">
    <h1 class="mb-4">Lista de Productos</h1>
      <a href="<?= base_url('agregarproducto') ?>" class="btn btn-success">Agregar</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)) : ?>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                    <tr>
                        <td><?= esc($producto['nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= esc($producto['cantidad']) ?></td>
                    </tr>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3" class="text-center">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>