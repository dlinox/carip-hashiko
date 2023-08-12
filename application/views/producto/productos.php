<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio'); ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="">Productos</a> </li>
                        <li class="breadcrumb-item active">Lista</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-purple">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mt-2 mr-1"></i>
                                Lista
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                    <label class="btn btn-sm bg-purple">
                                        <input class="crear" type="radio" name="options" id="option1" title="Registrar Producto" onclick="add_person()">
                                        <span class="fa fa-plus"></span> Nuevo Producto
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
                                    <div class="table-responsive">


                                        <table id="table" class="table table-striped table-bordered responsive dataTable  " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>NOMBRE</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>BENEFICIO</th>
                                                    <th>PRESENTACION(ES)</th>
                                                    <th>PRECIO(S)</th>
                                                    <th>INICIO</th>
                                                    <th>IMAGEN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="row">
                        <input type="hidden" value="" name="id">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombre: <span class="text-danger">*</span></label>
                                <input type="text" name="nombre" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripcion: <span class="text-danger">*</span></label>
                                <textarea name="descripcion" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Beneficio: <span class="text-danger">*</span></label>
                                <input type="text" name="beneficio" value="" autocomplete="off" placeholder="Beneficio" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mostrar en la pagina de inicio: <span class="text-danger">*</span></label>
                                <select class="form-control" name="inicio" id="inicio">
                                    <option value=""> Seleccione una opcion: </option>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Presentacion 1: <span class="text-danger">*</span></label>
                                        <input type="text" name="presentacion" value="" autocomplete="off" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Precio 1: <span class="text-danger">*</span></label>
                                        <input type="number" name="precio" value="" step="any" autocomplete="off" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="photo-preview">
                                        <label class="control-label">Imagen 1: <span class="text-danger">*</span></label>
                                        <div class="">
                                            (No hay Imagen 1)
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" id="label-photo">Subir Imagen 1 <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input name="photo" type="file">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Presentacion 2:</label>
                                        <input type="text" name="presentacion2" value="" autocomplete="off" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Precio 2:</label>
                                        <input type="number" name="precio2" value="NULL" step="any" autocomplete="off" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="photo-preview2">
                                        <label class="control-label">Imagen 2:</label>
                                        <div class="">
                                            (No Hay Imagen 2)
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" id="label-photo2">Subir Imagen 2 </label>
                                        <div class="col-md-9">
                                            <input name="photo2" type="file">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->