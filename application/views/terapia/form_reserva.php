<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" action="<?= base_url() ?>terapia/reserva_guardar/<?= $reserva->id_reserva ?>" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Nombres y Apellidos:</label>
                    <input class="form-control" type="text" value="<?= $cliente->nombres_cliente . " " . $cliente->apellidos_cliente; ?>" disabled>
                </div>

                <div class="form-group">
                    <label class="control-label">Terapia:</label>
                    <?= form_dropdown('terapia', $terapia, $reserva->terapia_reserva, array('class' => 'form-control', 'id' => 'terapia')); ?>
                </div>

                <div class="form-group">
                    <label class="control-label">Estado:</label>
                    <?= form_dropdown('estado', array('' => '*Seleccione', '1' => 'Confirmado', '2' => 'No Confirmado'), $reserva->estado_reserva, array('class' => 'form-control', 'id' => 'estado')); ?>

                </div>
                <div class="form-group">
                    <label class="control-label">Fecha de reserva:</label>
                    <input type="text" class="form-control" name="fecha" value="<?= $reserva->fecha_reserva; ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label">Dia de Atencion:</label>
                    <input type="date" class="form-control" name="dia" value="<?= $reserva->dia_reserva; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label">Hora de Atencion:</label>
                    <input type="time" class="form-control" name="hora" value="<?= $reserva->hora_reserva; ?>">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>