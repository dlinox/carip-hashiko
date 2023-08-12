<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hashiko</title>
  <link rel="shortcut icon" href="<?= base_url(); ?>/assets/web/img/logo.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/adminlte.min.css">

  <!-- Estilo Perzonalizado -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

  <?php
  $css = $this->cssjs->generate_css();
  echo isset($css) ? $css : "";
  ?>
</head>

<?php if ($this->router->class == 'login') :  ?>

  <body style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.1)), url(assets/img/fondo.png); background-repeat: no-repeat, repeat; background-size: cover;  background-blend-mode: darken;
" class="hold-transition sidebar-mini layout-fixed login-page">
  <?php else :  ?>

    <body class="hold-transition sidebar-mini sidebar-mini">
      <?php require_once(APPPATH . 'views/templates.html'); ?>
      <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="<?= base_url(); ?>assets/img/cubo-loader.gif" alt="AdminLTELogo" height="64" width="64">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-purple navbar-dark">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="<?= base_url('inicio/dashboard'); ?>" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="<?= base_url('web'); ?>" class="nav-link" target="_blank">Sitio Web</a>
            </li>
            <!--li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contacto</a>
            </li-->
          </ul>

          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url(); ?>assets/img/user.png" height="10" class="p-1 user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?= $this->session->userdata("username") ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

                <li class="user-header bg-purple">
                  <img src="<?= base_url(); ?>assets/img/user.png" class="p-1 img-circle elevation-2" alt="User Image">
                  <p>
                    <?= $this->session->userdata("username") ?>
                    <small></small>
                  </p>
                </li>

                <li class="user-footer text-center">
                  <!--a href="#" class="btn btn-outline-info btn-flat">Perfil</a-->
                  <a href="<?= base_url() ?>login/salir" class="btn px-4 btn-outline-danger">Salir</a>
                </li>
              </ul>
            </li>


          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- =============================================== -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-purple elevation-4">
          <!-- Brand Logo -->
          <a href="<?= base_url('inicio/dashboard'); ?>" class="brand-link bg-purple">
            <img src="<?= base_url(); ?>assets/img/logotipo.png" alt="AdminLTE Logo" class="brand-image img-circle " style="opacity: .8">
            <span class="brand-text font-weight-light">Hashiko</span>
          </a>

          <section class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENÚ PRINCIPAL</li>

                <?php
                $menu = $this->menu->getMenu();

                foreach ($menu as $i => $men) :
                  $cClass = $this->router->fetch_class();
                  $cMethod = $this->router->fetch_method();
                  $classli = "";
                  $ac = "";
                  $dir = explode("/", $men["url"]);
                  $nAdd = COUNT($men["add"]);
                  $hrefli = ($nAdd > 0) ? "#" : $men["url"];
                  $arrow = ($nAdd > 0) ? '<i class="fas fa-angle-left right"></i>' : '';
                  if ($nAdd > 0) {
                    $classli = "";
                  } else {
                    $classli = 'active';
                  }
                  if ($dir[0] == $cClass) $classli = $classli . " menu-open active";
                  if ($dir[0] == $cClass) $ac = $ac . "active";
                ?>
                  <li class="nav-item <?= $classli ?>">
                    <a class="nav-link <?= $ac; ?>" href="<?= base_url() . $hrefli ?>">
                      <i class="nav-icon <?= $men['icon'] ?>"></i>
                      <p><?= $men["name"] ?><i class="fas fa-angle-left right"></i></p>

                      <span>
                    </a>
                    <?php if ($nAdd > 0) : echo '<ul class="nav nav-treeview ">';
                      foreach ($men["add"] as $j => $sub) :
                        $sdir = explode("/", $sub["url"]);
                        $sclass = ($sdir[1] == $cMethod and $sdir[0] == $cClass) ? "menu-open" : "";
                        $s1 = ($sdir[1] == $cMethod and $sdir[0] == $cClass) ? "active" : "";
                    ?>
                  <li class="nav-item <?= $sclass ?>">
                    <a class="nav-link <?= $s1 ?>" href="<?= base_url() . $sub['url'] ?>">
                      <i class="nav-icon <?= $sub['icon'] ?>"></i>
                      <p><?= $sub["name"] ?>
                      </p>
                    </a>
                  </li>
              <?php endforeach;
                      echo "</ul>";
                    endif;  ?>

              </li>
            <?php endforeach ?>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->


          </section>
          <!-- /.sidebar -->
        </aside>
      <?php endif;  ?>