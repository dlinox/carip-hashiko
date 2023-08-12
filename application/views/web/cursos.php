</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('web'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary" >Cursos</a></li>
                </ol>
            </nav>
        </div>
    </nav>
</div>

<div class="cursos">
    <div class="container">
        <div class="titulo animate__animated animate__fadeInDown ">
            <h1 class="text-center text-secondary">Nuestros Cursos</h1>
        </div>
        <div class="row contenido animate__animated animate__fadeInRight ">

            <?php

            foreach ($cursos->result() as $curso) {
                $descripcion = $curso->descripcion_curso;
                $modalidad = $curso->modalidad_curso;

                if ($modalidad == '1') {
                    $modalidad = 'Presencial';
                    $color = "danger";
                } elseif ($modalidad == '2') {
                    $modalidad = 'Online';
                    $color = "info";
                } elseif ($modalidad == '3') {
                    $modalidad = 'Semipresencial';
                    $color = "warning";
                }

                if (strlen($descripcion) > 150) {
                    $descripcion = substr($descripcion, 0, 100);
                }
            ?>
                <div class="col-md-6 col-lg-4 py-4">
                    <div class="card h-100" ">
                            <div class="hover-zoom bg-image ripple imagen" data-mdb-ripple-color="light" href="<?= base_url(); ?>">
                        <img src="<?= base_url(); ?>/assets/img/upload/<?= $curso->imagen_curso; ?>" class=" img-fluid" />
                        <div class="mask" style="background: linear-gradient(to bottom, hsla(0, 0%, 0%, 0) 50%,#7d72dcbe);">
                            <div class=" d-flex justify-content-end align-items-top h-100">
                                <p class="px-2"> <span style="font-size: 12px;" class="badge bg-<?= $color; ?>"><?= $modalidad; ?></span></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body text-center">
                        <a href="<?= base_url('web/curso'); ?>/<?= $curso->id_curso; ?>">
                            <h4 class="card-title"><?= $curso->nombre_curso; ?></h4>
                        </a>

                    </div>
                    <div class="card-footer">
                        <div class="justify-content-center text-center">
                            <a href="<?= base_url('web/curso'); ?>/<?= $curso->id_curso; ?>" class="btn text-center btn-rounded btn-secondary  m-1">Más Informacion</a>
                        </div>
                    </div>
                </div>
        </div>
    <?php
            }
    ?>

    </div>
</div>

</div>
