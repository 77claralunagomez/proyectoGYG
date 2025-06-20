<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<section class="text-dark bg-light py-5 my-5">
    <div class="container" data-aos="fade-up">

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
        </div>
    </div>
</section>
<?= $this->endSection(); ?>