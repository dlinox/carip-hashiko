<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Cursos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="">Terapia</a> </li>
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
                                        <span class="fa fa-plus"></span> Nuevo Curso
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
                                                    <th>NOMBRE</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>DURACION</th>
                                                    <th>MODALIDAD</th>
                                                    <th>HORARIO</th>
                                                    <th>DOCENTE</th>
                                                    <th>COSTO</th>
                                                    <th>INICIO</th>
                                                    <th>IMAGEN</th>
                                                    <th>GUÍA</th>
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
                                <label>Nombre:<span class="text-danger">*</span></label>
                                <input type="text" name="nombre" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripcion:<span class="text-danger">*</span></label>
                                <textarea id="descripcion" name="descripcion" value="" class="form-control" cols="30" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duracion:<span class="text-danger">*</span></label>
                                <input type="text" name="duracion" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Modalidad:<span class="text-danger">*</span></label>
                                <select class="form-control" name="modalidad" id="modalidad">
                                    <option value=""> Seleccione una opcion: </option>
                                    <option value="1">Presencial</option>
                                    <option value="2">Online</option>
                                    <option value="3">Semipresencial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Horario:<span class="text-danger">*</span></label>
                                <input type="text" name="horario" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Docente:<span class="text-danger">*</span></label>
                                <input type="text" name="docente" value="" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Costo:<span class="text-danger">*</span></label>
                                <input type="number" name="costo" value="" step="any" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mostrar en la pagina de inicio:<span class="text-danger">*</span></label>
                                <select class="form-control" name="inicio" id="inicio">
                                    <option value=""> Seleccione una opcion: </option>
                                    <option value="1">Si</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                                    <input name="photo" type="file">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="guia-preview">
                                <label class="control-label">Guía Rapida</label>
                                <div class="">
                                    (No Guia)
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" id="label-guia">Guía Rapida </label>
                                <div class="col-md-9">
                                    <input name="guia" type="file">
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