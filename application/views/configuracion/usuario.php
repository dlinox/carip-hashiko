<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="">Configuracion</a> </li>
                        <li class="breadcrumb-item active">Usuario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mt-2 mr-1"></i>
                                Lista
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                    <label class="btn btn-sm btn-warning">
                                        <input class="crear" type="radio" name="options" id="option1" title="Nuevo Usuario" href="<?= base_url() ?>configuracion/usuario_crear">
                                        <span class="fa fa-plus"></span> Nuevo Usuario
                                    </label>
                                    <label class="btn btn-sm btn-dark active">
                                        <input type="radio" name="options" id="option2" data-card-widget="maximize"> <i class="fas fa-expand"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form class="ocform form-inline">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="search[value]" id="filtro" placeholder="Buscar" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Filtrar por: </label>
                                            <?= form_dropdown('tipo', $tipos, '', array('class' => 'form-control', 'id' => 'tipo', 'style' => "max-width: 400px")); ?>
                                        </div>


                                    </form>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <?php echo genDataTable('mitabla', $columns, true, true); ?>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>