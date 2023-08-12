<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Registrar nuevo usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
        </div>
        <?= form_open(base_url() . 'usuario/guardar/' . $usua->id_usua) ?>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nombre(s)<span class="text-danger">*</span> </label>
                        <?= form_input(array('name' => 'nombres', 'class' => 'form-control', 'value' => $usua->nombre_usua)) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Apellidos <span class="text-danger">*</span></label>
                        <?= form_input(array('name' => 'apellidos', 'class' => 'form-control', 'value' => $usua->apellido_usua)) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">N° DNI: <span class="text-danger">*</span></label>
                        <?= form_input(array('name' => 'dni', 'class' => 'form-control', 'value' => $usua->id_usua)) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Correo Electronico: </label>
                        <?= form_input(array('name' => 'email', 'class' => 'form-control', 'value' => $usua->email_usua)) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Teléfono:</label>
                        <?= form_input(array('name' => 'movil', 'class' => 'form-control', 'value' => $usua->movil_usua)) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <?= form_dropdown('habilitado', $estado, $usua->habilitado_usua, array('class' => 'form-control', 'id' => 'habilitado')); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <?= form_dropdown('tipo', $tipo, $usua->tipo_usua, array('class' => 'form-control', 'id' => 'tipo')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Usuario</label>
                        <input type="text" name="user" class="form-control" placeholder="Nombre de usuario" value="<?= $usua->user_usua ?>" <?= ($usua->id_usua != "" ? "disabled" : "") ?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" id="change_pass" name="change_pass" <?= ($usua->id_usua != "" ? "" : "disabled checked") ?>>
                            </span>
                            <input type="password" name="pass" placeholder="***********" class="form-control" <?= ($usua->id_usua != "" ? "disabled" : "") ?>>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>