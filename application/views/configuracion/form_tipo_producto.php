<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>

        </div>
        <?= form_open(base_url() . 'configuracion/tipo_producto_guardar/' . $tipoproducto->id_tipoprod) ?>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <?= form_input(array('name' => 'denominacion', 'placeholder' => 'Nombre', 'class' => 'form-control', 'value' => $tipoproducto->denominacion_tipoprod)) ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <?= form_input(array('name' => 'descripcion', 'placeholder' => 'Descripcion', 'class' => 'form-control', 'value' => $tipoproducto->descripcion_tipoprod)) ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?= form_close() ?>
    </div>
</div>