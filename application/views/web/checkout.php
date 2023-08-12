</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/tienda'); ?>">Tienda</a></li>
                    <li class="breadcrumb-item active"><a class="text-secondary">Checkout</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<div class="terapias">
    <div class="container">
        <div class="titulo animate__animated animate__fadeIn ">
            <h1 class="text-center text-secondary">Checkout</h1>
        </div>
        <div class="row contenido animate__animated animate__fadeInUp  ">

            <?php if (!empty($error_msg)) { ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                </div>
            <?php } ?>

            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark fw-light">TÚ CARRITO</span>
                    <span class="badge bg-danger badge-pill"><?php echo $this->cart->total_items(); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php if ($this->cart->total_items() > 0) {
                        foreach ($cartItems as $item) { ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <?php $imageURL = !empty($item["image"]) ? base_url('assets/img/upload/' . $item["image"]) : base_url('assets/images/pro-demo-img.jpeg'); ?>
                                    <img class="rounded-circle" src="<?php echo $imageURL; ?>" width="75" />
                                    <h6 class="text-dark fw-bold"><?php echo $item["name"]; ?></h6>
                                    <small class="text-primary"><?php echo 's/.' . $item["price"]; ?> (<?php echo $item["qty"]; ?> unid.)</small>
                                </div>
                                <span class="align-items-center justify-content-center text-primary"><?php echo 's/.' . $item["subtotal"]; ?></span>
                            </li>
                        <?php }
                    } else { ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <p>No tienes productos en tu carrito de compras</p>
                        </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="fw-bolder">Precio Total:</span>
                        <strong><?php echo 'S/.' . $this->cart->total(); ?></strong>
                    </li>
                </ul>
                <a href="<?php echo base_url('web/tienda'); ?>" class="btn btn-rounded btn-block btn-info">Añadir más Productos</a>
            </div>
            <div class="col-md-8 order-md-1">
                <div class="card p-4">
                    <h4 class="mb-3">Detalles del Cliente:</h4>
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" name="nombres" value="<?php echo !empty($custData['nombres']) ? $custData['nombres'] : ''; ?>" required>
                                    <label class="form-label" for="nombres">Nombre(s)</label>
                                </div>
                                <?php echo form_error('nombres', '<p class="text-danger error">', '</p>'); ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" name="apellidos" value="<?php echo !empty($custData['apellidos']) ? $custData['apellidos'] : ''; ?>" required>
                                    <label class="form-label" for="apellidos">Apellidos</label>
                                </div>
                                <?php echo form_error('apellidos', '<p class="text-danger error">', '</p>'); ?>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" name="dni" value="<?php echo !empty($custData['dni']) ? $custData['dni'] : ''; ?>" required>
                                    <label class="form-label" for="dni">DNI</label>
                                </div>
                                <?php echo form_error('dni', '<p class="text-sm text-danger error">', '</p>'); ?>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-outline mb-3">
                                    <input type="email" class="form-control" name="correo" value="<?php echo !empty($custData['correo']) ? $custData['correo'] : ''; ?>" required>
                                    <label class="form-label" for="correo">Correo Electronico</label>
                                </div>
                                <?php echo form_error('correo', '<p class="text-sm text-danger error">', '</p>'); ?>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" name="telefono" value="<?php echo !empty($custData['telefono']) ? $custData['telefono'] : ''; ?>" required>
                                    <label class="form-label" for="telefono">N° de Telefono</label>
                                </div>
                                <?php echo form_error('telefono', '<p class="text-sm text-danger error">', '</p>'); ?>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" name="direccion" value="<?php echo !empty($custData['direccion']) ? $custData['direccion'] : ''; ?>" required>
                                    <label class="form-label" for="direccion">Direccion</label>
                                </div>
                                <?php echo form_error('direccion', '<p class="text-sm text-danger error">', '</p>'); ?>
                            </div>
                        </div>

                        <input class="btn btn-rounded btn-success btn-lg btn-block" type="submit" name="placeOrder" value="Realizar Compra">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>