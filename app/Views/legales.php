<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<section class="bg-light py-5 my-5 font-monospace text-justify">
    <div class="container">
        <div style="text-align: center;">

            <?= view('terminos'); ?>

            <h2 class="text-center mb-4">Pedidos y Devoluciones</h2>
            <p style="text-align: justify;">
                Una vez realizado tu pedido, el mismo será procesado y preparado para su envío. Nos comprometemos a despachar los productos en el menor tiempo posible, aunque los plazos pueden variar según disponibilidad de stock o validación de receta óptica.
            </p>
            <p style="text-align: justify;">
                Las devoluciones solo serán aceptadas si el producto presenta fallas de fábrica, está dañado o si no coincide con el artículo solicitado. No se aceptan devoluciones por errores de elección de modelo, color o graduación una vez confirmado el pedido con receta.
            </p>
            <p style="text-align: justify;">
                Para iniciar una devolución, deberás contactarnos dentro de los 7 días corridos desde la recepción del producto, conservando el empaque original y sin signos de uso. Una vez recibida la devolución y verificado el estado del producto, realizaremos el reintegro correspondiente.
            </p>

            <h2 class="text-center mb-4">Derecho de Arrepentimiento</h2>
            <p style="text-align: justify;">
                Se aceptará la cancelación de la compra siempre y cuando la misma no hubiera sido despachada. En caso de que el pedido ya haya sido enviado, deberás aguardar a recibirlo y luego iniciar el proceso de devolución según lo indicado en la sección anterior.
            </p>
            <p style="text-align: justify;">
                Para ejercer este derecho, deberás notificar de manera fehaciente tu intención de cancelar la compra enviando un correo a <strong>claragomez968@gmail.com</strong> o comunicándote durante nuestro horario de atención por <strong>Whatsapp <a href="https://wa.me/5493794060957/" target="_blank">AQUÍ</a></strong>.
            </p>
            <p style="text-align: justify;">
                El reintegro del importe abonado se realizará, de ser posible, por el mismo medio utilizado en la compra.
            </p>
            <p style="text-align: justify;">
                Para más información podés consultar nuevamente estos Términos y Condiciones.
            </p>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>