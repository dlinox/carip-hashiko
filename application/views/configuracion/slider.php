<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Sliders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="">Configuracion</a> </li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mt-2 mr-1"></i>
                                Lista
                            </h3>
                            <div class="card-tools">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                    <label class="btn btn-sm btn-primary">
                                        <input class="crear" type="radio" name="options" id="option1" title="Registrar Terapia" onclick="add_person()">
                                        <span class="fa fa-plus"></span> Nuevo Slider
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

                                    <!--button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
                                    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button-->
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-bordered table-hover responsive  dataTable no-footer" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>COD</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>LINK</th>
                                                    <th>ESTADO</th>
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
    <div class="modal-dialog">
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
                                <label>Descripcion:<span class="text-danger">*</span></label>
                                <input type="text" name="descripcion" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enlace:<span class="text-danger">*</span></label>
                                <input type="url" name="link" placeholder="https://example.com" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Estado:<span class="text-danger">*</span></label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="">  Seleccione una opcion:  </option>
                                    <option value="1">Activado</option>
                                    <option value="2">Desactivado</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group" id="photo-preview">
                                <label class="control-label">Foto</label>
                                <div class="">
                                    (No photo)
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" id="label-photo">Subir Foto </label>
                                <div class="col-md-9">
                                    <input class="" name="photo" type="file">
                                    <span class="help-block"></span>
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