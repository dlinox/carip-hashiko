<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" HASHIKO VIDA - Terapias alternativas para público en general -cursos talleres para adultos -productos para terapeutas.">
    <meta name="keywords" content="HASHIKO VIDA atención y capacitación en terapias alternativas para el bienestar y la salud integral.">
    <meta name="author" content="HASHIKO VIDA">
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/web/img/logo.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap CSS -->

    <!-- Animate Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=Cantora+One&display=swap" rel="stylesheet">
    <!-- MDB -->

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/web/css/mdb.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/web/css/hashiko.css">

    <title>Hashiko Vida</title>

    <?php
    $css = $this->cssjs->generate_css();
    echo isset($css) ? $css : "";
    ?>
</head>

<body>


    <header>

        <!-- Navbar -->
        <nav class="menu navbar navbar-expand-lg navbar-dark fixed-top mask-custom shadow-0">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('web'); ?>">
                    <img src="<?= base_url(); ?>/assets/web/img/logotipo.png" height="35" alt="Logo">
                    <span class="logo-text" style="color: #fff;">Hashiko </span><span class="text-light d-none d-lg-block d-xl-none" style="font-size: 11px;"> Bienestar en tu vida</span>
                </a>
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('web'); ?>"><img src="<?= base_url(); ?>/assets/web/img/icons/home.svg" height="20" alt="10">
                                Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('web/nosotros'); ?>"><img src="<?= base_url(); ?>/assets/web/img/icons/nosotros.svg" height="20" alt=""> Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('web/cursos'); ?>"><img src="<?= base_url(); ?>/assets/web/img/icons/cursos.svg" height="20" alt="">Cursos</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('web/terapias'); ?>" class="nav-link"><img src="<?= base_url(); ?>/assets/web/img/icons/terapias.svg" height="20" alt=""> Terapias</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('web/tienda'); ?>" class="nav-link"><img src="<?= base_url(); ?>/assets/web/img/icons/tienda.svg" height="20" alt="">
                                Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('web/contactenos'); ?>" class="nav-link"><img src="<?= base_url(); ?>/assets/web/img/icons/contacto.svg" height="20" alt=""></i> Contáctenos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-flex flex-row barra-lateral ">
                        <li class="nav-item me-4 m3-lg-0">
                            <a type="button" href="<?= base_url('web/reservacion'); ?>" class=" btn btn-sm btn-danger btn-floating animate__animated animate__pulse  animate__infinite">
                                <img src="<?= base_url(); ?>/assets/web/img/icons/calendar.svg" height="16" alt="">
                            </a>
                        </li>

                        <!--li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                                aria-expanded="false">
                                <img src="<?= base_url(); ?>/assets/web/img/icons/user.svg" height="22" alt="User" loading="lazy" />
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="#">Mi perfil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Configuracion</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Salir</a>
                                </li>
                            </ul>
                        </li-->
                        <li class="nav-item me-3 me-lg-0">

                            <a class="nav-link market" href="<?= base_url('login'); ?>">
                                <?= $this->session->userdata("username") ?>
                                <img src="<?= base_url(); ?>/assets/web/img/icons/user.svg" height="22" alt="User" loading="lazy" />
                            </a>
                        </li>
                        <li class="nav-item me-3 me-lg-0">
                            <a class="nav-link market" href="<?=base_url('web/carrito')?>">
                                <img src="<?= base_url(); ?>/assets/web/img/icons/market.svg" height="22" alt="User" loading="lazy" />
                                <span class="badge rounded-pill badge-notification bg-danger"><?php echo ($this->cart->total_items() > 0) ? $this->cart->total_items() . '' : '0'; ?></span>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->