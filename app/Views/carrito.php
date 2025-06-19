<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5 ">
    <div class="mt-5 mt-carousel">.</div>
    <h2 class="mb-4">🛒 Carrito de Compras</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($items as $item): ?>
                    <?php $subtotal = $item['price'] * $item['qty']; ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td><?= esc($item['qty']) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="<?= base_url('eliminarDelCarrito/' . $item['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm">🗑 Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php $total += $subtotal; ?>
                <?php endforeach; ?>
                <tr class="table-secondary fw-bold">
                    <td colspan="3" class="text-end">Total</td>
                    <td>$<?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= base_url('catalogo') ?>" class="btn btn-outline-primary">🛍️ Seguir Comprando</a>
            <a href="<?= base_url('pedido/procesar') ?>" class="btn btn-success">💳 Finalizar Compra</a>
        </div>

    <?php else: ?>
        <div class="alert alert-info">
            Tu carrito está vacío. <a href="<?= base_url('catalogo') ?>">¡Agregá productos!</a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>