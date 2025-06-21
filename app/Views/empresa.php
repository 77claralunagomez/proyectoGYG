<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>

<section class="bg-light py-5 my-5 font-monospace text-justify">
    <div class="container">
         <div style="text-align: center;">
            <br>
            <h2 style="font-style: italic;">Sobre Nosotros </h2>
            <h3>Descubre más <span>Sobre Nosotros</span></h3>
            <br>
        </div>

        <div class="row">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <br>
                <img src="assets/img/cat2.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                data-aos-delay="100">
                <h3>¿Quiénes somos?</h3>
                <p style="text-align: justify;">
                    Somos una óptica comprometida con el cuidado de tu visión. Con años de experiencia en el rubro,
                    nuestro objetivo es brindarte no solo productos de calidad, sino también una atención
                    personalizada, cercana y profesional. Creemos que ver bien es vivir mejor, y trabajamos cada día
                    para ayudarte a lograrlo.
                </p>

                <h3>¿Qué hacemos?</h3>
                <p style="text-align: justify;">
                    Ofrecemos una amplia variedad de anteojos, lentes de sol, lentes de contacto. Trabajamos con
                    marcas reconocidas y tecnología de última generación para asegurarte precisión, estilo y
                    comodidad en cada producto. Además, contamos con asesoramiento personalizado para que elijas el
                    diseño que mejor se adapte a tu rostro y estilo de vida.
                </p>

                <h3>¿Por qué elegirnos?</h3>
                <p style="text-align: justify;">
                    Porque combinamos calidad, experiencia y calidez humana. En nuestra óptica no solo te ayudamos a
                    ver mejor, también te hacemos sentir bien atendido. Nos diferenciamos por nuestra dedicación, la
                    confianza que generamos en cada cliente y la pasión con la que trabajamos. Eleginos y descubrí
                    una nueva forma de cuidar tu mirada.
                </p>
                <br>
            </div>
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
