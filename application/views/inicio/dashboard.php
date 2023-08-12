<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $venta->ventas; ?></h3>

                            <p>Ventas del día</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?= base_url('/producto/ventas') ?>" class="small-box-footer">Más Informacion <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $reserva->reservas; ?></h3>

                            <p>Reservas de Hoy</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                        <a href="<?= base_url('terapia/reserva') ?>" class="small-box-footer">Más Informacion <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $inscripcion->preinscripciones; ?></h3>

                            <p>Preinscripciones de Hoy</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="<?= base_url('curso/preinscripcion') ?>" class="small-box-footer">Masa Informacion <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $cliente->clientes; ?></h3>

                            <p>Nuevos Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="<?= base_url('clientes') ?>" class="small-box-footer">Mas Informacion <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            Ventas
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>


                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-danger">
                        <div class="card-header">
                            Top 4 productos más vendidos
                        </div>
                        <div class="card-body">
                            <canvas id="producto" width="400" height="400"></canvas>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>

</div>