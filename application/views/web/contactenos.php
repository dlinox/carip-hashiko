</header>
<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('web'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary">Contactenos</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<!-- Section: Design Block -->
<section class="contactenos">
    <!-- Jumbotron -->
    <div class="container">
        <div class="titulo animate__animated animate__fadeInDown ">
            <h1 class="text-center text-secondary">Contáctenos</h1>
        </div>

        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-4 lead animate__animated animate__fadeInUp">Tiene usted alguna pregunta? Por favor, no dude en contactarnos directamente. Nuestro equipo se comunicará contigo para ayudarte.</p>
        <div class="row gx-lg- align-items-center animate__animated animate__fadeInRight">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3 class="my-5  fw-bold text-primary">
                    Hashiko <br />
                    <span class="text-info">bienestar en tu vida</span>
                </h3>
                <hr class="my-4">

                <h5 class="ls-tight my-2">Puntos de Contacto:</h5>
                <p class="lead "><button class="btn btn-sm btn-success btn-floating"><i class="fas fa-phone-square"></i></button> 999978644 / 998643786 </p>
                <p class="lead "><button class="btn btn-sm btn-primary btn-floating"><i class="fas fa-envelope"></i></button> hashikobienestarentuvida@gmail.com</p>
                <h5 class="my-2 fw-normal">Direccion:</h5>
                <p class="lead "><button class="btn btn-sm btn-secondary btn-floating"><i class="fas fa-map-marker-alt"></i></button> Jr. Santiago Antonio Lishner N°1710. Cercado de Lima, Perú.</p>
                <h5 class="my-2">Horario de Atencion:</h5>
                <p class="lead "><button class="btn btn-sm btn-danger btn-floating"><i class="fas fa-clock"></i></button> Lunes a sábado: 10:00 am - 8:00 pm | <span class="text-warning">Previa Cita</span> </p>

            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 animate__animated animate__fadeInLeft">
                <div class="card">
                    <div class="card-body py-5 px-md-5">
                        <p class="text-muted fw-light">Estamos en Contacto</p>
                        <h3 class=" mb-4">Escríbenos</h3>

                        <?= form_open(base_url() . 'web/enviar_mensaje') ?>

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="nombres" name="nombres" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="nombres">Nombre(s)</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="apellidos" name="apellidos" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="apellidos">Apellidos</label>
                                </div>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="correo" name="correo" class="form-control" autocomplete="off" />
                            <label class="form-label" for="correo">Correo Electronico</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="asunto" name="asunto" class="form-control" autocomplete="off" />
                            <label class="form-label" for="asunto">Asunto</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" autocomplete="off"></textarea>
                            <label class="form-label" for="mensaje">Mensaje</label>
                        </div>



                        <!-- Submit button -->
                        <button type="submit" value="Guardar" class="btn btn-primary btn-rounded btn-block mb-4">
                            Enviar
                        </button>


                        <?= form_close(); ?>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->