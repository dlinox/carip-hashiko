</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/cursos'); ?>">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary"><?= $cursos->nombre_curso; ?></a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>
<?php $modalidad = $cursos->modalidad_curso;

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
?>
<!-- Jumbotron -->
<div class="curso_inicio">
    <div class="p-5 text-center bg-image rounded-3" style=" background-image: url('<?= base_url() . "/assets/img/upload/" . $cursos->imagen_curso; ?>'); height: 400px;">
        <div class="mask" style="background: linear-gradient( hsla(0, 0%, 0%, 0.5) 50%,#7d72dcbe);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3 text-light fw-bolder"><?= $cursos->nombre_curso; ?></h1>
                    <a class="btn btn-outline-<?= $color; ?> btn-sm btn-rounded" href="#!" role="button"><?= " " . $modalidad; ?></a>

                </div>
            </div>
        </div>
    </div>
    <div class="curso_redes">
        <?php
        $host = $_SERVER["HTTP_HOST"];
        $url = $_SERVER["REQUEST_URI"];
        $link =  "https://" . $host . $url;

        ?>

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
    <div class="curso_info">
        <div class="container">
            <?= $cursos->descripcion_curso; ?>

            <div class="row detalles">
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Duracion:</h4>
                    <p class="lead"><?= $cursos->duracion_curso; ?></p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Modalidad:</h4>
                    <p class="lead"><?= $modalidad; ?></p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Horario:</h4>
                    <p class="lead"><?= $cursos->horario_curso; ?></p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Inversion:</h4>
                    <p class="lead"><?= "S/. " . $cursos->costo_curso; ?></p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Docente:</h4>
                    <p class="lead"><?= $cursos->docente_curso; ?></p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="">Medios de Pago:</h4>
                    <p class="fw-light">Deposito en las siguientes cuentas:</p>

                    <button type="button" class="btn btn-floating btn-lg btn-secondary animate__animated animate__pulse  animate__infinite" data-mdb-toggle="modal" data-mdb-target="#modalYape"><img src="<?= base_url(); ?>/assets/img/yape1.png" height="45" alt=""></button>
                    <button type="button" class="btn btn-floating btn-lg btn-primary animate__animated animate__pulse  animate__infinite" data-mdb-toggle="modal" data-mdb-target="#modalBcp"><img src="<?= base_url(); ?>/assets/img/bcp.svg" width="45" alt=""></button>
                    <button type="button" class="btn btn-floating btn-lg btn-light animate__animated animate__pulse  animate__infinite" data-mdb-toggle="modal" data-mdb-target="#modalBn"><img src="<?= base_url(); ?>/assets/img/bn.png" width="45" alt=""></button>
                    <button type="button" class="btn btn-floating btn-lg btn-info animate__animated animate__pulse  animate__infinite" data-mdb-toggle="modal" data-mdb-target="#modalBbva"><img src="<?= base_url(); ?>/assets/img/bbva.svg" width="40" alt=""></button>
                    <p class="mt-4 fw-light">
                        <span class="text-danger">*</span> Transferencia Bancaria (libre de comisión por agente Bcp, Bbva y/o banca móvil o banco de la nación)
                    </p>
                    <p class="fw-light"><span class="text-danger">*</span> En caso sea de provincia: (libre de comisión por banco de la nación.) Abono por ventanilla incluir comisión del banco S/. 9 00</p>
                </div>
                <div class="col-md-12 text-center p-1">
                    <h4 class="mb-2">Informes e Inscripciones:</h4>
                    <a href="<?= base_url('web/inscripcion'); ?>/<?= $cursos->id_curso; ?>" class="btn btn-primary btn-lg btn-rounded my-2"><i class="fas fa-calendar-alt"></i> Inscripcion</a>
                    <a href="https://wa.me/+51999978644/?text=<?= "%0A%20%20%20%20%20%20%20%20%20%20INFORMACION DEL CURSO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20CURSO:%20%20%20" . $cursos->nombre_curso; ?>" target="_blank" class="btn btn-success btn-lg btn-rounded  my-2"><i class="fab fa-whatsapp"></i> 999978644</a>

                    <?php if ($cursos->guia_rapida_curso) : ?>
                        <a href="<?= base_url('assets/guias/upload'); ?>/<?= $cursos->guia_rapida_curso; ?>" target="_blank" class="btn btn-danger btn-lg btn-rounded my-2 "><i class="fas fa-file-pdf"></i> Guía Rapida</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalYape" tabindex="-1" aria-labelledby="modalYapeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #742284 !important; color:white;">
            <div class="modal-header">
                <button type="button" class="btn-close text-light" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url(); ?>/assets/img/pagoyape.jfif" class="img-fluid" alt="">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalBcp" tabindex="-1" aria-labelledby="modalBcpLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #002a8d !important; color:white;">
            <div class="modal-header">
                <button type="button" class="btn-close text-light" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url(); ?>/assets/img/bcp.png" class="img-fluid" alt="">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalBn" tabindex="-1" aria-labelledby="modalBnLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #fff !important; color:white;">
            <div class="modal-header">
                <button type="button" class="btn-close text-light" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url(); ?>/assets/img/bna.png" class="img-fluid" alt="">
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalBbva" tabindex="-1" aria-labelledby="modalBbvaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #072146 !important; color:white;">
            <div class="modal-header">
                <button type="button" class="btn-close text-light" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url(); ?>/assets/img/bbva.png" class="img-fluid" alt="">
            </div>

        </div>
    </div>
</div>