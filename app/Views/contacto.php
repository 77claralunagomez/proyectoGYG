<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<section class="bg-light text-dark py-5">
    <br>
    <div class="text-center m-5">
        <h1>Contactanos</h1>
        <h3>Mandanos un mensaje y te respondemos al correo lo antes posible</h3>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 col-md-6 col-lg-4">
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control border-black" id="email" name="email" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control border-black" id="mensaje"
                            name="mensaje" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
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