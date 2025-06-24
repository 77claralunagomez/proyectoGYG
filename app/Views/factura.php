<!-- app/Views/detalle_factura.php -->
<?= $this->extend('plantilla') ?>

<?= $this->section('content') ?>
<div class="container mt-5 my-5 mt-carousel py-5">

    <div class="mt-5 mt-carousel">.</div>
    <h2 class="mb-4">Factura Nº <?= esc($factura['id_factura']) ?></h2>

    <div class="row mb-3">
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <p><strong>Cliente:</strong> <?= esc($factura['nombre_cliente']) ?></p>
        </div>
        <div class="col-md-6 text-md-end">
            <p><strong>Fecha:</strong> <?= esc(date('d/m/Y', strtotime($factura['fecha_factura']))) ?></p>
        </div>
    </div>

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
            <?php foreach ($detalles as $item): ?>
                <?php $subtotal = $item['precio_unitario'] * $item['cantidad']; ?>
                <tr>
                    <td><?= esc($item['nombre_producto']) ?></td>
                    <td>$<?= number_format($item['precio_unitario'], 2) ?></td>
                    <td><?= esc($item['cantidad']) ?></td>
                    <td>$<?= number_format($subtotal, 2) ?></td>
                </tr>
                <?php $total += $subtotal; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary fw-bold">
                <td colspan="3" class="text-end">Total</td>
                <td>$<?= number_format($total, 2) ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<?= $this->endSection() ?>