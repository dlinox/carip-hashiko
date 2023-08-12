<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?= base_url() ?>curso/preinscripcion_guardar/<?= $inscripcion->id_inscripcion ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Nombres y Apellidos:</label>
                    <input class="form-control" type="text" value="<?= $cliente->nombres_cliente . " " . $cliente->apellidos_cliente; ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="control-label">Curso:</label>
                    <?= form_dropdown('curso', $curso, $inscripcion->curso_inscripcion, array('class' => 'form-control', 'id' => 'curso')); ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Estado:</label>
                    <?= form_dropdown('estado', array('' => '*Seleccione', '1' => 'Confirmado', '2' => 'No Confirmado'), $inscripcion->estado_inscripcion, array('class' => 'form-control', 'id' => 'estado')); ?>

                </div>
                <div class="form-group">
                    <label class="control-label">Fecha de inscripcion:</label>
                    <input type="text" class="form-control" name="fecha" value="<?= $inscripcion->fecha_inscripcion ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">Observacion:</label>
                    <?= form_textarea(array('name' => 'observacion', 'class' => 'form-control', 'rows' => '3', 'cols' => '50', 'value' => $inscripcion->observacion_inscripcion)) ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>