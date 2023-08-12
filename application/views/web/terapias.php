</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('web'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary">Terapias</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<div class="terapias ">
    <div class="container">
        <div class="titulo animate__animated animate__fadeIn ">
            <h1 class="text-center text-secondary">Terapias</h1>
        </div>
        <div class="row contenido animate__animated animate__fadeInUp  ">

            <?php
            foreach ($terapias->result() as $terapia) {
                $descripcion = $terapia->descripcion_terapia;
                $animacion = "fadeInLeft";
                if ($terapia->id_terapia % 2 == 0) {
                    $animacion = "fadeInRight";
                }

                if (strlen($descripcion) > 185) {
                    $descripcion = substr($descripcion, 0, 190);
                }

            ?>
                <div class="col-lg-11 tarjeta animate__animated animate__<?= $animacion; ?>">
                    <div class="card">
                        <div class="row tarjeta-contenido">
                            <div class="col-md-4 col-lg-3 imagen">

                                <div class="ih-item circle effect6 scale_up">
                                    <a href="<?= base_url('web/terapia/') . $terapia->id_terapia; ?>">
                                        <div class="img"><img src="<?= base_url(); ?>/assets/img/upload/<?= $terapia->imagen_terapia; ?>" alt="img"></div>
                                        <div class="info">
                                            <div class="info-back">
                                                <h3><?= $terapia->nombre_terapia; ?></h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 informacion">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $terapia->nombre_terapia; ?></h3>
                                    <p class="text-justify"><?= $descripcion . ""; ?><a href="<?= base_url('web/terapia/') . $terapia->id_terapia; ?>"> ...Leer más</a></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3 botones">
                                <div class="container-fluid">
                                    <a type="button" href="<?= base_url('web/terapia/') . $terapia->id_terapia; ?>" class="btn btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                        <i class="fas fa-eye"></i> Más Informacion
                                    </a>
                                    <a type="button" href="<?= base_url('web/reserva/') . $terapia->id_terapia; ?>" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark">
                                        <i class="fas fa-calendar-alt"></i> Reservar Cita
                                    </a>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>

            <?php
            }

            ?>



            <!--div class="col-md-10 tarjeta animate__animated animate__fadeInRight">
                <div class="card">
                    <div class="row tarjeta-contenido">
                        <div class="col-md-3 imagen">

                            <div class="ih-item circle effect6 scale_up"><a href="">
                                    <div class="img"><img src="<?= base_url(); ?>/assets/web/img/talleres/sanacion.jpg" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Sanacion Energética</h3>

                                        </div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-md-6 informacion">
                            <div class="card-body">
                                <h3 class="card-title">Sanacion Energética</h3>
                                <p>Estimula y potencia las energías de auto sanación efectuando los cambios necesarios en el aura o (campo electromagnético) a fin de liberar la energía "olvidada" que pueda estar atajada por el tiempo y así sanar cualquier enfermedad.

                                    Invitan a percibir, evaluar y limpiar el campo electromagnético de tu cuerpo (AURA) y tus siete centros mayores de energía (CHAKRAS).
                                </p>

                            </div>
                        </div>
                        <div class="col-md-3 botones">
                            <div class="container-fluid">
                                <button type="button" class="btn  btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                    <i class="fas fa-eye"></i> Más Informacion
                                </button>
                                <button type="button" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark"><i class="fas fa-calendar-alt"></i> Reservar Cita

                                </button>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-10 tarjeta">
                <div class="card">
                    <div class="row tarjeta-contenido">
                        <div class="col-md-3 imagen">

                            <div class="ih-item circle effect6 scale_up"><a href="#">
                                    <div class="img"><img src="<?= base_url(); ?>/assets/web/img/talleres/reiki.jpg" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Reiki</h3>

                                        </div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-md-6 informacion">
                            <div class="card-body">
                                <h3 class="card-title">Reiki</h3>
                                <p>Terapia de sanación por imposición de manos que ayuda al paciente a retornar a su estado original en que el cuerpo y el alma funcionan en armonía con el universo.
                                </p>

                            </div>
                        </div>
                        <div class="col-md-3 botones">
                            <div class="container-fluid">
                                <button type="button" class="btn  btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                    <i class="fas fa-eye"></i> Más Informacion
                                </button>
                                <button type="button" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark"><i class="fas fa-calendar-alt"></i> Reservar Cita

                                </button>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-10 tarjeta">
                <div class="card">
                    <div class="row tarjeta-contenido">
                        <div class="col-md-3 imagen">

                            <div class="ih-item circle effect6 scale_up"><a href="#">
                                    <div class="img"><img src="<?= base_url(); ?>/assets/web/img/talleres/quiropractica.jpg" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Quiropráctica</h3>

                                        </div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-md-6 informacion">
                            <div class="card-body">
                                <h3 class="card-title">Quiropráctica Energética y Tradicional</h3>
                                <p>La quiropráctica es la profesión sanitaria que se ocupa del diagnostico, tratamiento y prevención de desórdenes sobre el sistema nervioso y su relación con la columna vertebral, las emociones y sentimientos.

                                    Su propósito es restaurar y mantener la integridad de la columna y sus múltiples ramificaciones de nervios, nervios que están protegidos por las vertebras de la columna.</p>

                            </div>
                        </div>
                        <div class="col-md-3 botones">
                            <div class="container-fluid">
                                <button type="button" class="btn  btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                    <i class="fas fa-eye"></i> Más Informacion
                                </button>
                                <button type="button" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark"><i class="fas fa-calendar-alt"></i> Reservar Cita

                                </button>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-10 tarjeta">
                <div class="card">
                    <div class="row tarjeta-contenido">
                        <div class="col-md-3 imagen">

                            <div class="ih-item circle effect6 scale_up"><a href="#">
                                    <div class="img"><img src="<?= base_url(); ?>/assets/web/img/talleres/reflexologia+.jpg" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Reflexologia</h3>

                                        </div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-md-6 informacion">
                            <div class="card-body">
                                <h3 class="card-title">Reflexologia</h3>
                                <p>Es la práctica de estimular puntos sobre los pies o manos (llamados «zonas de reflejo»), donde ese masaje tiene un efecto benéfico en un órgano situado en otro lugar del cuerpo. </p>

                            </div>
                        </div>
                        <div class="col-md-3 botones">
                            <div class="container-fluid">
                                <button type="button" class="btn  btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                    <i class="fas fa-eye"></i> Más Informacion
                                </button>
                                <button type="button" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark"><i class="fas fa-calendar-alt"></i> Reservar Cita

                                </button>
                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-10 tarjeta">
                <div class="card">
                    <div class="row tarjeta-contenido">
                        <div class="col-md-3 imagen">

                            <div class="ih-item circle effect6 scale_up"><a href="#">
                                    <div class="img"><img src="<?= base_url(); ?>/assets/web/img/talleres/acupuntura.jpg" alt="img"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3>Acupuntura</h3>

                                        </div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="col-md-6 informacion">
                            <div class="card-body">
                                <h3 class="card-title">Acupuntura</h3>
                                <p>Práctica de la medicina tradicional china y japonesa que consiste en la introducción de agujas muy finas en determinados puntos del cuerpo humano para aliviar dolores y curar diversas enfermedades. Tiene una finalidad curativa o terapéutica. </p>

                            </div>
                        </div>
                        <div class="col-md-3 botones">
                            <div class="container-fluid">
                                <button type="button" class="btn  btn-rounded btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
                                    <i class="fas fa-eye"></i> Más Informacion
                                </button>
                                <button type="button" class="btn btn-rounded  btn-block btn-danger" data-mdb-ripple-color="dark"><i class="fas fa-calendar-alt"></i> Reservar Cita

                                </button>
                            </div>

                        </div>

                    </div>


                </div>
            </div-->



        </div>

    </div>

</div>
<!-- Button trigger modal -->