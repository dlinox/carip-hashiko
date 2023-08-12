</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a class="text-secondary" href="<?= base_url('web/tienda'); ?>">Carrito</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<div class="terapias">
    <div class="container">
        <div class="titulo animate__animated animate__fadeIn ">
            <h1 class="text-center text-secondary">Carrito</h1>
        </div>
        <div class="contenido animate__animated animate__fadeInUp  ">
            <div class="card table-responsive">
                <table class="table align-middle table-hover ">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">Imagen</th>
                            <th class="fw-bold">Producto</th>
                            <th class="fw-bold">Presentacion</th>
                            <th class="fw-bold">Precio</th>
                            <th class="fw-bold text-center">Cantidad</th>
                            <th class="fw-bold">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($this->cart->total_items() > 0) {
                            foreach ($cartItems as $item) {    ?>
                                <tr>
                                    <td class="text-center">
                                        <?php $imageURL = !empty($item["image"]) ? base_url('assets/img/upload/' . $item["image"]) : base_url('assets/images/pro-demo-img.jpeg'); ?>
                                        <img class="rounded-circle" src="<?php echo $imageURL; ?>" width="50" />
                                    </td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td>
                                        <?php if ($this->cart->has_options($item['rowid']) == TRUE) : ?>

                                            <?php foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value) : ?>

                                                <?php echo $option_value; ?>

                                            <?php endforeach; ?>


                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo 'S/.' . $item["price"]; ?></td>
                                    <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                                    <td class="text-dark"><?php echo 'S/.' . $item["subtotal"]; ?></td>
                                    <td class="text-center"><button class="btn btn-rounded btn-sm btn-danger" onclick="return confirm('Seguro de Eliminar?')?window.location.href='<?php echo base_url('web/removeItem/' . $item["rowid"]); ?>':false;"> Eliminar </button> </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-dark text-center fw-bolder">
                                    <p class="text-danger fw-light">Carrito Vacio.....</p>
                                </td>
                            <?php } ?>
                            <?php if ($this->cart->total_items() > 0) { ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end text-primary"><strong>Precio Total:</strong></td>
                                <td class="text-dark fw-bold"><strong><?php echo 'S/.' . $this->cart->total() . ' Soles'; ?></strong></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row py-4">
                <div class="col-lg-6 text-center mt-3">
                    <a href="<?= base_url('web/tienda'); ?>" class="btn btn-rounded btn-primary"><i class="fas fa-shopping-cart"></i> Continuar Comprando</a>
                </div>
                <div class="col-lg-6 text-center mt-3">
                    <a href="<?= base_url('web/checkout'); ?>" class="btn btn-rounded btn-success"><i class="fas fa-cash-register"></i> Finalizar Compra</a>
                </div>

            </div>
        </div>
    </div>
</div>