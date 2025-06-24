<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<section class="bg-light py-5 my-5 font-monospace text-justify">
    <div class="container">
         <?= view('aboutUs'); ?>
        <h2 class="text-center mb-4">Política de Privacidad</h2>

        <p style="text-align: justify;">
            En <strong>optica gyg</strong> nos comprometemos a proteger la privacidad de nuestros clientes y usuarios. Esta Política de Privacidad describe cómo recopilamos, usamos, almacenamos y compartimos tu información personal, conforme a la Ley de Protección de Datos Personales N.º 25.326 de la República Argentina.
        </p>

        <h5 class="mt-4">1. Información que Recopilamos</h5>
        <p style="text-align: justify;">
            Recopilamos los siguientes tipos de datos cuando interactuás con nosotros:
            <ul>
                <li>Datos de contacto: nombre, apellido, DNI, dirección, email, teléfono.</li>
                <li>Datos de salud visual: receta médica, historial óptico.</li>
                <li>Datos de pago: información necesaria para realizar facturas o procesar pagos.</li>
            </ul>
        </p>

        <h5 class="mt-4">2. Cómo Usamos Tu Información</h5>
        <p style="text-align: justify;">
            Utilizamos tu información para:
            <ul>
                <li>Gestionar tus pedidos, facturación y entregas.</li>
            </ul>
        </p>

        <h5 class="mt-4">3. Seguridad de los Datos</h5>
        <p style="text-align: justify;">
            Implementamos medidas de seguridad físicas, electrónicas y administrativas para proteger tu información personal. Limitamos el acceso a tus datos solo al personal autorizado que los necesita para brindar nuestros servicios.
        </p>

        <h5 class="mt-4">4. Con Quién Compartimos Tu Información</h5>
        <p style="text-align: justify;">
            No vendemos tus datos. Podemos compartir tu información con:
            <ul>
                <li>Laboratorios ópticos, si es necesario para la fabricación de tus lentes.</li>
                <li>Plataformas de pago seguras para gestionar tus compras.</li>
                <li>Obligaciones legales o requerimientos de autoridades competentes.</li>
            </ul>
        </p>

        <h5 class="mt-4">5. Tus Derechos</h5>
        <p style="text-align: justify;">
            Tenés derecho a acceder, actualizar, rectificar o eliminar tus datos personales.
        </p>

        <h5 class="mt-4">6. Cambios en esta Política</h5>
        <p style="text-align: justify;">
            Nos reservamos el derecho de modificar esta política para adaptarla a cambios legislativos o mejoras del servicio. Te sugerimos revisarla periódicamente.
        </p>
    </div>
</section>

<?= $this->endSection(); ?>
