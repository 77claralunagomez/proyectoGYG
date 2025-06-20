<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<section class="bg-light text-center py-5 my-5">
    <br>
    <div>
        <h1>Metodos de Pago y envio</h1>
    </div>
    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center mx-4">
        <div class="col">
            <div class="card border-black">
                <img src="assets/img/tarjetaicon.png" class="card-img-top card-icon" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Formas de pago</h5>
                    <p class="card-text">Consultá nuestras formas de pago disponibles.</p>
                    <p class="d-inline-flex gap-1">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePagos" aria-expanded="false" aria-controls="collapseExample">
                            Ver más
                        </button>
                    </p>
                    <div class="collapse" id="collapsePagos">
                        <div class="d-flex align-items-center mb-2">
                            <img src="assets/img/tarjetas.png" width="64" height="56" alt="">
                            <span class="ms-2">Tarjetas de crédito y débito</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <img src="assets/img/mercadopago.png" width="64" height="56" alt="">
                            <span class="ms-2">Transferencias</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="assets/img/cash.png" width="64" height="56" alt="">
                            <span class="ms-2">Efectivo</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-black">
                <img src="assets/img/camionicon.png" class="card-img-top card-icon" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tipo de entregas</h5>
                    <p class="card-text">Conocé los métodos de envío que ofrecemos.</p>
                    <p class="d-inline-flex gap-1">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEnvio" aria-expanded="false" aria-controls="collapseExample">
                            Ver más
                        </button>
                    </p>
                    <div class="collapse" id="collapseEnvio">
                        <div class="d-flex align-items-center mb-2">
                            <img src="assets/img/tienda.png" width="64" height="56" alt="">
                            <span class="ms-2">Retiro en tienda</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <img src="assets/img/camion-entrega.png" width="64" height="56" alt="">
                            <span class="ms-2">Envios éstandar</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="assets/img/camion-entrega-express.png" width="64" height="56" alt="">
                            <span class="ms-2">Entregas express</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</section>
<?= $this->endSection(); ?>