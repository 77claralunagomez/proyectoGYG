<?= $this->extend('plantilla') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
  <h2 class="mb-4">Factura #<?= esc($factura['id_factura']) ?></h2>

  <div class="card mb-4">
    <div class="card-body">
      <p><strong>Cliente:</strong> <?= esc($factura['nombre_usuario']) ?> (<?= esc($factura['email']) ?>)</p>
      <p><strong>Fecha:</strong> <?= esc($factura['fecha_factura']) ?></p>
      <p><strong>Total:</strong> $<?= esc($factura['total']) ?></p>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      Detalles de la Factura
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($detalles)): ?>
            <?php foreach ($detalles as $detalle): ?>
              <tr>
                <td><?= esc($detalle['nombre_producto']) ?></td>
                <td><?= esc($detalle['cantidad']) ?></td>
                <td>$<?= esc($detalle['precio']) ?></td>
                <td>$<?= esc(number_format($detalle['precio'] * $detalle['cantidad'], 2)) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="4" class="text-center">No hay productos en esta factura.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-4">
    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">Volver al Dashboard</a>
  </div>
</div>

<?= $this->endSection() ?>
