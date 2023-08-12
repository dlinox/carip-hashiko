</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/terapias'); ?>">Terapia</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary"><?= $terapias->nombre_terapia; ?></a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>
<!-- Jumbotron -->
<div class="terapia_inicio">
    <div class="p-5 text-center bg-image rounded-3" style=" background-image: url('<?= base_url() . "/assets/img/upload/" . $terapias->imagen_terapia; ?>'); height: 400px;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3 text-light fw-bolder"><?= $terapias->nombre_terapia; ?></h1>
                    <a class="btn btn-outline-light btn-sm btn-rounded" href="<?= base_url('web/reserva') . '/' . $terapias->id_terapia; ?>" role="button"><i class="fas fa-calendar-alt"></i> Reservar Cita</a>

                </div>
            </div>
        </div>
    </div>
    <div class="terapia_redes">

        <div class="text-center pt-4 pb-4 align-items-center">

            <a href="https://www.facebook.com/hashikobienestarentuvida" class="btn btn-floating btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://wa.me/+51999978644/" target="_blank" class="btn btn-floating btn-success m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://twitter.com/perezpati36" target="_blank" class="btn btn-floating btn-info m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            
        </div>
    </div>
    <div class="terapia_info">
        <div class="container">
            <?= $terapias->descripcion_terapia; ?>

            <div class="row detalles">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-clock text-info fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h5 class="text-info"><?= $terapias->duracion_terapia; ?></h5>
                                    <p class="mb-0">Duracion</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="far fa-user  text-warning fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h5 class="text-warning"><?= $terapias->terapeuta_terapia; ?></h5>
                                    <p class="mb-0">Terapeuta</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-dollar text-success fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h5 class="text-success"><?= "S/. " . $terapias->costo_terapia; ?></h5>
                                    <p class="mb-0">Costo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="reserva text-center">
                <img src="" alt="">
                <a href="<?= base_url('web/reserva') . '/' . $terapias->id_terapia; ?>" class="btn btn-secondary btn-lg btn-rounded mb-5"><i class="fas fa-calendar-alt"></i> Reservar Cita</a>
                <a type="button" class="btn btn-success btn-lg btn-rounded  mb-5" data-mdb-toggle="modal" data-mdb-target="#reservaModal"><i class="fab fa-whatsapp"></i> Reserva por Whatsapp</a>


            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal top fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservaModalLabel">Reserva <?= $terapias->nombre_terapia; ?></h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="formulario" id="formulario">
                    <!-- 2 column grid layout with text inputs for the first and last names -->

                    <div class="form-outline mb-4">
                        <input type="text" id="nombres" class="form-control form-control-lg" autocomplete="off" />
                        <label class="form-label" for="nombres">Nombre(s) y Apellidos</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="dni" class="form-control form-control-lg" autocomplete="off" />
                        <label class="form-label" for="dni">DNI</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" id="correo" class="form-control form-control-lg" autocomplete="off" />
                        <label class="form-label" for="correo">Correo Electronico</label>
                    </div>

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="terapia" class="form-control form-control-lg" value="<?= $terapias->nombre_terapia; ?>" disabled autocomplete="off" />
                        <label class="form-label" for="terapia">Terapia</label>
                    </div>

                    <!-- Text input -->

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-outline">
                                <input type="text" id="fecha" name="fecha" class="form-control form-control-lg" autocomplete="off" />
                                <label class="form-label" for="fecha">Fecha</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-outline">
                                <input type="time" id="hora" class="form-control form-control-lg   " autocomplete="off" />
                                <label class="form-label" for="hora">Hora</label>
                            </div>
                        </div>

                    </div>

                    <!-- Submit button -->
                    <button type="submit" id="submit" class="btn btn-success btn-rounded btn-block mb-4"><i class="fab fa-whatsapp"></i> Realizar Reserva</button>
                </form>
            </div>

        </div>
    </div>
</div>