</header>

<div class="miga-pan">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/cursos'); ?>">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Inscripcion</a></li>
                </ol>
            </nav>
        </div>
    </nav>
</div>

<div class="inscripcion">
    <div class="container">
        <div class="titulo animate__animated animate__fadeInDown ">
            <h1 class="text-center text-secondary">Pre Inscripcion</h1>
        </div>
        <div class="row contenido animate__animated animate__fadeInRight justify-content-center">




            <div class="col-lg-10">
                <div class="card mb-8">

                    <div class="card-body">

                        <?= form_open(base_url() . 'web/guardar_inscripcion/', ['id' => 'form-1']); ?>

                        <div class="row">
                            <h4 class="card-title my-3">Datos Personales:</h4>
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
                            <div class="col-md-4 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="dni" name="dni" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="dni">DNI:</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="telefono" name="telefono" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="telefono">N° de Telefono:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline">
                                    <input type="email" id="correo" name="correo" class="form-control" autocomplete="off" />
                                    <label class="form-label" for="correo">Correo Electronico:</label>
                                </div>
                            </div>
                            <h4 class="card-title my-3">Datos del Curso:</h4>
                            <div class="col-md-4 mb-4">
                                <?= form_dropdown('tipo', $tipo, '', array('class' => 'form-control browser-default custom-select text-secondary text-uppercase', 'id' => 'curso', 'name' => 'curso')); ?>

                            </div>
                            <div class="col-md-8 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="observacion" name="observacion" class="form-control" />
                                    <label class="form-label" for="observacion">Observacion:</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" value="Guardar" class="btn btn-lg btn-rounded px-5 btn-secondary">
                                Enviar
                            </button>
                        </div>
                        <?= form_close() ?>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>