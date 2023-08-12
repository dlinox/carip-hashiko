</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/tienda'); ?>">Carrito</a></li>
                    <li class="breadcrumb-item active"><a class="text-secondary">Orden</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<div class="terapias">
    <div class="container">
        <div class="titulo animate__animated animate__fadeIn ">
            <h1 class="text-center text-secondary">ESTADO DE LA COMPRA</h1>
        </div>
        <div class="row contenido animate__animated animate__fadeInUp  ">
            <?php if (!empty($order)) { ?>
                <div class="col-md-12">
                    <div class="alert alert-info">Su solicitud de compra se a realizado con exito.</div>
                </div>

                <!-- Order status & shipping info -->
                <div class="row col-lg-4 ord-addr-info">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm ">
                            <thead>
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
                                    <th>PRECIO</th>
                                    <td> <?php echo "S/." . $order['grand_total']; ?></td>
                                </tr>
                                <tr>
                                    <th>CORREO</th>
                                    <td> <?php echo $order['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>TELEFONO</th>
                                    <td> <?php echo $order['phone']; ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </div>

                <!-- Order items -->
                <div class="row col-lg-8">
                    <table class="table align-middle table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase" colspan="5">lista de productos</th>
                            </tr>
                            <tr>

                                <th></th>
                                <th>Producto</th>
                                <th>Presentacion</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
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
            <?php } else { ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">Your order submission failed.</div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>