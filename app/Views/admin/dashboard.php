<!-- app/Views/admin/dashboard.php -->
<?= $this->extend('plantilla') ?>
<?= $this->section('content') ?>

<div class="container mt-5">

  <h2 class="mb-4">Panel de Administración</h2>

  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="card-text fs-4"><?= esc($totalUsuarios) ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Facturas</h5>
          <p class="card-text fs-4"><?= esc($totalFacturas) ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-info mb-3">
        <div class="card-body">
          <h5 class="card-title">Total vendido</h5>
          <p class="card-text fs-4">$<?= esc($totalVentas) ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">
      Últimas Facturas
    </div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($facturas as $factura): ?>
            <tr>
              <td><?= esc($factura['id_factura']) ?></td>
              <td><?= esc($factura['id_usuario']) ?></td>
              <td><?= esc($factura['fecha_factura']) ?></td>
              <td>$<?= esc($factura['total']) ?></td>
              <td>
                <a href="<?= base_url('admin/factura/' . $factura['id_factura']) ?>" class="btn btn-sm btn-info">Ver</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
    
  <div class="card">
    <div class="card-header">
      Usuarios registrados
    </div>
    <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuariosActivados as $u): ?>
            <tr>
              <td><?= esc($u['id_usuario']) ?></td>
              <td><?= esc($u['email']) ?></td>
              <td><?= esc($u['rol']) ?></td>
              <td>
                <form action="<?= base_url('admin/usuario/eliminar') ?>" method="post" style="display:inline;">
                  <?= csrf_field() ?>
                  <input type="hidden" name="id_usuario" value="<?= esc($u['id_usuario']) ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
               
              </td>

            </tr>

          <?php endforeach; ?>
          
        </tbody>
      </table>
      <div class="card-header">
      Usuarios Desactivados
      </div>
       <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Rol</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuariosDesactivados as $u): ?>
            <tr>
              <td><?= esc($u['id_usuario']) ?></td>
              <td><?= esc($u['email']) ?></td>
              <td><?= esc($u['rol']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?= $this->endSection() ?>