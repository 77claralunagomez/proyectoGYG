<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<section class="bg-light py-5 my-5 font-monospace text-justify">
    <div class="container">

        <div class="text-center mb-4">
            <h2 class="mb-3">¿Cómo comprar?</h2>
        </div>

        <p style="text-align: justify;">
            Realizar una compra en <strong>optica GYG</strong> es muy simple. Seguí estos pasos:
        </p>

        <ol style="text-align: justify;">
            <li>
                Las compras se realizan en nuestro shop online
                <a href="<?= base_url('catalogo') ?>" target="_blank">AQUÍ</a>.
            </li>
            <li>Elegí los productos que vas a comprar. Si querés más de uno, sumalos a tu carrito.</li>
            <li>Pagá con el medio de pago que quieras.</li>
            <li>Recibí el producto que esperás. Elegí la forma de entrega que prefieras ¡y listo!</li>
            <li>
                Podrás ver en la página del producto si se puede pagar en cuotas y con qué medios.
                Si decidís comprarlo, antes de pagar podrás elegir la cantidad de cuotas y te informaremos el valor de cada una.
            </li>
            <li>
                Para hacer un cambio o devolución, contactanos para que podamos ayudarte.
                Si comprás y no es lo que esperabas, podés devolverlo sin cargo
                (<a href="<?= base_url('terminos') ?>">aplican Términos y condiciones</a>).
            </li>
        </ol>
         <?= view('contacto'); ?>
        <hr class="my-5">
    </div>
</section>

<?= $this->endSection(); ?>
