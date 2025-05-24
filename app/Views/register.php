<div class="container mt-5">
    <h2 class="text-center mb-4">Registro de Usuario</h2>

    <?php if (session('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= base_url('store') ?>" method="post" class="card p-4 shadow-sm">

        <h4 class="mb-3">Datos personales</h4>
        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" value="<?= old('dni') ?>">
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>">
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= old('apellido') ?>">
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?= old('telefono') ?>">
        </div>

        <h4 class="mt-4 mb-3">Cuenta de Usuario</h4>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="pass" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrarme</button>
    </form>
</div>
