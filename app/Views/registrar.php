<?= $this->extend('plantilla'); ?>

<?= $this->section('content'); ?>
<section class="py-5 my-5">

    <div class="card shadow-lg form-signin">
        <div class="card-body p-5">
            <h1 class="fs-4 card-title fw-bold mb-4">Registro</h1>
            <form method="POST" action="<?= base_url('registrar') ?>" autocomplete="off">
    
                <?= csrf_field(); ?>
    
                <div class="mb-3">
                    <label class="mb-2" for="nombre">Nombre</label>
                    <input class="form-control" name="nombre" id="nombre" value="<?= set_value('nombre'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="mb-2" for="apellido">Apellido</label>
                    <input class="form-control" name="apellido" id="apellido" value="<?= set_value('apellido'); ?>" required>
                </div>
    
                <div class="mb-3">
                    <label class="mb-2" for="domicilio">Domicilio</label>
                    <input class="form-control" name="domicilio" id="domicilio" value="<?= set_value('domicilio'); ?>" required>
                </div>
    
                <div class="mb-3">
                    <label class="mb-2" for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" required>
                </div>
    
                <div class="mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="pass" id="pass" required>
                </div>
    
    
                <div class="mb-3">
                    <label for="repassword">Confirmar contraseña</label>
                    <input type="password" class="form-control" name="repassword" id="repassword" required>
                </div>
    
                <button type="submit" class="btn btn-primary">
                    Registrar
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
                <a href="<?= base_url('iniciarsesion') ?>">Iniciar sesión</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>