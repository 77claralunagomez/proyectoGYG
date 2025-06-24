<?= $this->extend('plantilla') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h1 class="text-center mb-4">Listado de Consultas</h1>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
    <?php endif; ?>

    <?php if (!empty($consultas)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID consulta</th>
                        <th>ID Usuario</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Mensaje</th>
                        <th>Activo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $c): ?>
                        <tr>
                            <td><?= esc($c['id_consulta']) ?></td>
                            <td><?= esc($c['id_usuario']) ?></td>
                            <td><?= esc($c['nombre']) . ' ' . esc($c['apellido']) ?></td>
                            <td><?= esc($c['email']) ?></td>
                            <td><?= esc($c['mensaje']) ?></td>
                            <td>
                                <?php if ($c['activo']): ?>
                                    <span class="badge bg-success">Activa</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactiva</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No hay consultas registradas.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>