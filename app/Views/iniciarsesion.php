<?= $this->extend('plantilla'); ?>

<?= $this->section('content'); ?>
<div class="card shadow-lg form-signin">
    <div class="card-body p-5">
        <h1 class="fs-4 card-title fw-bold mb-4">Iniciar sesión</h1>
        <form method="POST" action="<?= base_url('autenticar') ?>" autocomplete="off">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label class="mb-2" for="usuario">email</label>
                <input type="email" class="form-control" name="email" id="email" required autofocus>
            </div>

            <div class="mb-3">
                <div class="mb-2 w-100">
                    <label for="password">Contraseña</label>
                </div>
                <input type="password" class="form-control" name="pass" id="pass" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Ingresar
            </button>
        </form>

        <?php if (session()->getFlashdata('errors') !== null) : ?>
            <div class="alert alert-danger my-3" role='alert'>
                <?= session()->getFlashdata('errors'); ?>
            </div>
        <?php endif; ?>

    </div>
    <div class="card-footer py-3 border-0">
        <div class="text-center">
            ¿No tienes una cuenta? <a href="<?= base_url('registrar') ?>" class="text-dark">Registrate aquí</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>