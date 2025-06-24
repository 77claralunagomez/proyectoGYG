<?= $this->extend('plantilla'); ?>
<?= $this->section('content'); ?>
<section class="container-fluid col-10 my-5 py-5">
    <!--Acordion-->
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne">
                    ¡Bienvenido a Óptica GYG!
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <p>
                        En Óptica GYG, somos dos jóvenes emprendedores apasionados por el cuidado visual y el estilo.
                        Fundamos esta óptica con la misión de brindar una experiencia cercana, moderna y confiable,
                        combinando salud visual y diseño de vanguardia.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                    Nuestra historia
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <p>GYG nació del deseo de transformar la forma en que las personas cuidan su vista.
                        Con formación profesional y espíritu emprendedor,
                        decidimos crear un espacio donde cada cliente pueda encontrar lentes de receta y de sol
                        que se adapten a sus necesidades, personalidad y estilo de vida.
                        Empezamos con una pequeña tienda y gracias a la confianza de nuestros clientes,
                        hoy seguimos creciendo.
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                    Nuestro equipo
                </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="row p-2 d-flex justify-content-center">
                        <div class="col-4 p-2 m-2 card text-center" style="width: 18rem;">
                            <img src="assets/img/duenos.png" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Mauro Gonzalez</h5>
                                <h5 class="card-title">Clara Gomez</h5>
                                <p class="card-text">
                                    Representantes de GyG optica
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>