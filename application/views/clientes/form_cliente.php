<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Default Modal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>

        </div>

        <?= form_open(base_url() . 'clientes/cliente_guardar/' . $cliente->id_cliente) ?>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">

                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label>N° DNI:</label>
                            <?= form_input(array('name' => 'dni', 'id' => 'dni', 'class' => 'form-control', 'value' => $cliente->dni_cliente)) ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label>Nombre(s):</label>
                            <?= form_input(array('name' => 'nombres', 'id' => 'nombres', 'placeholder' => 'Nombre(s)', 'class' => 'form-control', 'value' => $cliente->nombres_cliente)) ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Apellido:</label>
                            <?= form_input(array('name' => 'apellidos', 'id' => 'apellidos', 'placeholder' => 'Apellido', 'class' => 'form-control', 'value' => $cliente->apellidos_cliente)) ?>
                        </div>
                    </div>

                    <div class="col-sm-12 ">
                        <div class="form-group">
                            <label>Telefono:</label>
                            <?= form_input(array('name' => 'telefono', 'class' => 'form-control', 'value' => $cliente->telefono_cliente)) ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Correo Electronico:</label>
                            <?= form_input(array('name' => 'correo', 'class' => 'form-control', 'value' => $cliente->correo_cliente)) ?>
                        </div>
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