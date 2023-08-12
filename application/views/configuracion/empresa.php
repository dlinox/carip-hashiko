<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Empresa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="">Configuracion</a> </li>
                        <li class="breadcrumb-item active">Empresa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                    <label class="btn btn-sm btn-primary">
                                        <input class="crear" type="radio" name="options" id="option1" title="Registrar Categoria" href="<?= base_url() ?>hotel/categoria_crear"><span class="fa fa-edit"></span> Editar
                                    </label>
                                    <label class="btn btn-sm btn-dark active">
                                        <input type="radio" name="options" id="option2" data-card-widget="maximize"> <i class="fas fa-expand"></i>
                                    </label>
                                </div>

                            </div>

                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>assets/img/user4-128x128.jpg" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Nombre de Hotel</h3>

                            <p class="text-muted text-center">Slogan</p>
                            <div class="container-fluid">


                                <strong><i class="fas fa-map-marker-alt"></i> Direccion</strong>
                                <p class="text-muted">Av. El Sol, Perú</p>
                                <hr>
                                <strong><i class="fas fa-envelope"></i> Correo</strong>
                                <p class="text-muted">
                                    empresa@gmail.com
                                </p>
                                <hr>
                                <strong><i class="fas fa-flag"></i> Pais</strong>
                                <p class="text-muted">
                                    Peru
                                </p>
                                <hr>
                                <strong><i class="fas fa-phone"></i> Telefono</strong>
                                <p class="text-muted">
                                    999345678
                                </p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> RUC</strong>
                                <p class="text-muted">
                                    10705285680
                                </p>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Configuracion</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#datos-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="datos-part" id="datos-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Datos</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#ubicacion-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="ubicacion-part" id="ubicacion-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Ubicación</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#imagen-part">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="imagen-part" id="imagen-part-trigger">
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">Imagen</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="datos-part" class="content" role="tabpanel" aria-labelledby="datos-part-trigger">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Empresa">
                                            </div>
                                            <div class="form-group">
                                                <label for="ruc">RUC</label>
                                                <input type="text" class="form-control" id="ruc" name="ruc" placeholder="RUC">
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono">N° Telefono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="N° de Telefono">
                                            </div>
                                            <div class="form-group">
                                                <label for="correo">Correo Electronico</label>
                                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electronico">
                                            </div>
                                            <button class="btn btn-primary" type="button" onclick="stepper.next()">Siguiente</button>
                                        </div>

                                        <div id="ubicacion-part" class="content" role="tabpanel" aria-labelledby="ubicacion-part-trigger">
                                            <div class="form-group">
                                                <label for="direccion">Direccion</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
                                            </div>
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                                            </div>
                                            <div class="form-group">
                                                <label for="pais">Pais</label>
                                                <input type="text" class="form-control" id="pais" name="pais" placeholder="Pais">
                                            </div>
                                            <button class="btn btn-danger" type="button" onclick="stepper.previous()">Anterior</button>
                                            <button class="btn btn-primary" type="button" onclick="stepper.next()">Siguiente</button>
                                        </div>

                                        <div id="imagen-part" class="content" role="tabpanel" aria-labelledby="imagen-part-trigger">
                                            <div class="form-group">
                                                <label for="slogan">Slogan</label>
                                                <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Slogan">
                                            </div>
                                            <div class="form-group">
                                                <label for="imagen">Imagen</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                                        <label class="custom-file-label" for="imagen">Elija la Imagen</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Subir</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-danger" type="button" onclick="stepper.previous()">Anterior</button>
                                            <button type="submit" class="crear btn btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
</div>