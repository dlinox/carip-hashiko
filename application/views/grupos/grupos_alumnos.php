<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $titulo ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <form class="ocform form-inline" action="asignar_grupo" method="POST">
                    <div class="alert alert-danger error-message-paquete hidden" role="alert"></div>
                    <div class="row mb15">
                        <div id="box-curso-periodo"></div>
                        <div class="col-sm-3">
                            <select name="id_alumno" class="form-control select2 id_alumno"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <input class="btn btn-block btn-success" type="submit" name="asignar_usuario" value="Asignar Grupo">
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <?php echo genDataTable('mitabla', $columns, true, true); ?>
                </div>
            </div>
        </div>
    </section>
</div>