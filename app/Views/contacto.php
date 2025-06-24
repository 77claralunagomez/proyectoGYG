<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<section class="bg-light text-dark py-5">

    <div class="text-center m-3">
        <h1>Contacto</h1>
        <h1>Ante cualquier consulta contactanos!</h1>
        <h3>Mandanos un mensaje y te respondemos al correo lo antes posible</h3>
    </div>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('mensaje'); ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 col-md-6 col-lg-4">

                <form action="<?= base_url('consulta/enviar'); ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if (!session()->get('logged_in')): ?>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    <?php else: ?>
                         <p>Enviando como: <strong><?= session('nombre') ?></strong></p>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control border-black" name="mensaje" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Consulta</button>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed toast-top-custom start-50 translate-middle-x">
        <div id="liveToast" class="toast align-items-center text-white bg-success border-1"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="me-2">✅</span>
                <strong class="me-auto">Mensaje enviado!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Se ha mandado correctamente.
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>