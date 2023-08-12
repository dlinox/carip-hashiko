<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Default Modal</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>

    </div>
    <?= form_open(base_url() . 'usuario/guardar/' . $usua->id_usua) ?>
    <div class="modal-body">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label class="control-label">Nombre(s)</label>
            <?= form_input(array('name' => 'nombres', 'placeholder' => 'Nombre(s)', 'class' => 'form-control', 'value' => $usua->nombre_usua)) ?>
          </div>
          <div class="col-sm-6">
            <label class="control-label">Apellidos</label>
            <?= form_input(array('name' => 'apellidos', 'placeholder' => 'Apellidos', 'class' => 'form-control', 'value' => $usua->apellido_usua)) ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-4">
            <label class="control-label">DNI</label>
            <?= form_input(array('name' => 'dni', 'placeholder' => 'N° de DNI', 'class' => 'form-control', 'value' => $usua->id_usua)) ?>

          </div>
          <div class="col-sm-5">
            <label class="control-label">Email</label>
            <?= form_input(array('name' => 'email', 'placeholder' => 'Correo Electronico', 'class' => 'form-control', 'value' => $usua->email_usua)) ?>

          </div>
          <div class="col-sm-3">
            <label class="control-label">Teléfono</label>
            <?= form_input(array('name' => 'movil', 'placeholder' => 'N° Telefono', 'class' => 'form-control', 'value' => $usua->movil_usua)) ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label class="control-label">Usuario</label>
            <input type="text" name="user" class="form-control" placeholder="Nombre de usuario" value="<?= $usua->user_usua ?>" <?= ($usua->id_usua != "" ? "disabled" : "") ?>>
          </div>
          <div class="col-sm-6">
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
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label class="control-label">Tipo</label>
            <?= form_dropdown('tipo', $tipo, $usua->tipo_usua, array('class' => 'form-control', 'id' => 'tipo')); ?>
          </div>
          <div class="col-sm-6">
            <label class="control-label">Estado</label>
            <?= form_dropdown('habilitado', $estado, $usua->habilitado_usua, array('class' => 'form-control', 'id' => 'habilitado')); ?>
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