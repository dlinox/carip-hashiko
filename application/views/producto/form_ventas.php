<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Registrar nuevo usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
        </div>
        <?= form_open(base_url() . 'producto/venta_actualizar/' . $order['id']) ?>
        <div class="modal-body">

            <div class="row  ">
                <?php if (!empty($order)) { ?>


                    <!-- Order status & shipping info -->
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm ">
                                <thead class="bg-info">
                                    <tr>
                                        <th class="text-center text-uppercase" colspan="2">Informacion de la Compra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>CODIGO</th>
                                        <td># 000 - <?php echo $order['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>FECHA:</th>
                                        <td><?php echo $order['created']; ?></td>

                                    </tr>
                                    <tr>
                                        <th>CLIENTE</th>
                                        <td> <?php echo $order['name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>CORREO</th>
                                        <td> <?php echo $order['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TELEFONO</th>
                                        <td> <?php echo $order['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>PRECIO TOTAL:</th>
                                        <td class="fw-bolder text-primary"> <?php echo "S/." . $order['grand_total']; ?></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>

                    <!-- Order items -->
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table align-middle table-sm table-hover">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-uppercase" colspan="6">lista de productos</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>

                                        <th></th>
                                        <th>Producto</th>
                                        <th>Presentacion</th>
                                        <th>Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th>Sub Total</th>
                                    </tr>

                                    <?php
                                    if (!empty($order['items'])) {
                                        foreach ($order['items'] as $item) {
                                    ?>
                                            <tr>
                                                <td>

                                                    <?php
                                                    if ($item['sub_total'] / $item['quantity'] == $item['price']) {
                                                        $imageURL = !empty($item["image"]) ? base_url('assets/img/upload/' . $item["image"]) : base_url('assets/images/pro-demo-img.jpeg');
                                                    } else {
                                                        $imageURL = !empty($item["image2"]) ? base_url('assets/img/upload/' . $item["image2"]) : base_url('assets/images/pro-demo-img.jpeg');
                                                    }

                                                    ?>
                                                    <img class="rounded-circle" src="<?php echo $imageURL; ?>" width="50" />
                                                </td>
                                                <td><?php echo $item["name"]; ?></td>
                                                <td>
                                                    <?php

                                                    if ($item['sub_total'] / $item['quantity'] == $item['price']) {
                                                        echo  $item["presentacion"];
                                                    } else {
                                                        echo $item["presentacion2"];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($item['sub_total'] / $item['quantity'] == $item['price']) {
                                                        echo 'S/.' . $item["price"];
                                                    } else {
                                                        echo 'S/.' . $item["price2"];
                                                    }
                                                    ?>

                                                </td>
                                                <td><?php echo $item["quantity"]; ?></td>
                                                <td><?php echo 's/.' . $item["sub_total"]; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger">Your order submission failed.</div>
                    </div>
                <?php } ?>

                <div class="col-lg-12">




                    <div class="col-lg-4 text-center">
                        <div class="form-group">
                            <label class="text-danger control-label">Estado</label>
                            <?= form_dropdown('estado', $estado, $order['status'], array('class' => 'form-control', 'id' => 'estado')); ?>
                        </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

            <?= form_close(); ?>



        </div>
    </div>