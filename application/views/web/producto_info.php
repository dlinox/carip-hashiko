</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('web/tienda'); ?>">Tienda</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary"><?= $productos->nombre_producto; ?></a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>
<div class="producto_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">

                    <div id="carouselProductos" class="carousel slide carousel-dark" data-mdb-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-fluid d-block w-100" src="<?= base_url() . '/assets/img/upload/' . $productos->imagen_producto; ?>" alt="">
                            </div>
                            <?php
                            if ($productos->imagen2_producto != null) {
                            ?>
                                <div class="carousel-item">
                                    <img class="img-fluid d-block w-100" src="<?= base_url() . '/assets/img/upload/' . $productos->imagen2_producto; ?>">
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselProductos" data-mdb-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-mdb-target="#carouselProductos" data-mdb-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>

            </div>
            <div class="col-lg-6 my-4 p-4">
                <h2 class="text-secondary fw-bold"><?= $productos->nombre_producto; ?></h2>

                <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button id="presentacion_producto" class="btn-sm nav-link active" id="pills-home-tab2" data-mdb-toggle="pill" data-mdb-target="#pills-home2" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                            <?= $productos->presentacion_producto; ?>
                        </button>
                    </li>

                    <?php if ($productos->presentacion2_producto != null) {
                    ?>
                        <li id="info2" class="nav-item" role="presentation">
                            <button id="presentacion2_producto" class="btn-sm nav-link" id="pills-profile-tab2" data-mdb-toggle="pill" data-mdb-target="#pills-profile2" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <?= $productos->presentacion2_producto; ?>
                            </button>
                        </li>
                    <?php
                    }
                    ?>



                </ul>

                <div class="tab-content" id="pills-tabContent2">
                    <div class="tab-pane fade show active" id="pills-home2" role="tabpanel" aria-labelledby="pills-home-tab2">


                        <div class="product-price">
                            <p class="lead new-price">Precio: <span id="precio_producto"><?= "S/. " . $productos->precio_producto; ?></span></p>
                        </div>
                        <div class="product-detail">
                            <p class="" id="descripcion_producto"><?= $productos->descripcion_producto; ?></p>
                            <ul>
                                <li>Beneficio: <span id="beneficio_producto"><?= $productos->beneficio_producto; ?></span></li>

                            </ul>
                        </div>

                        <div class="py-4">
                            <a href="https://wa.me/+51999978644/?text=<?= "%0A%20%20%20%20%20%20%20%20%20%20VENTA DE PRODUCTO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRE:%20%20%20" . $productos->nombre_producto . "%0A%20%20%20PRESENTACION:%20%20%20" . $productos->presentacion_producto; ?>" target="_blank" class="btn btn-success btn-rounded  my-2"><i class="fab fa-whatsapp"></i> Comprar por whatsapp</a>
                            <a href="<?php echo base_url('web/aagregar_carrito/' . $productos->id_producto) . "/1/"; ?>" class="btn btn-primary btn-rounded my-2"> <i class="fas fa-shopping-cart"></i> Agregar a Carrito</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab2">


                        <div class="product-price">
                            <p class="lead new-price">Precio: <span id="precio_producto"><?= 'S/. ' . $productos->precio2_producto; ?></span></p>
                        </div>
                        <div class="product-detail">
                            <p class="" id="descripcion_producto"><?= $productos->descripcion_producto; ?></p>
                            <ul>
                                <li>Beneficio: <span id="beneficio2_producto"><?= $productos->beneficio_producto; ?></span></li>

                            </ul>
                        </div>


                        <div class="py-4">
                            <a href="https://wa.me/+51999978644/?text=<?= "%0A%20%20%20%20%20%20%20%20%20%20VENTA DE PRODUCTO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRE:%20%20%20" . $productos->nombre_producto . "%0A%20%20%20PRESENTACION:%20%20%20" . $productos->presentacion2_producto; ?>" target="_blank" class="btn btn-success btn-rounded  my-2"><i class="fab fa-whatsapp"></i> Comprar por whatsapp</a>
                            <a href="<?php echo base_url('web/aagregar_carrito/' . $productos->id_producto . "/2/"); ?>" class="btn btn-primary btn-rounded my-2"> <i class="fas fa-shopping-cart"></i> Agregar a Carrito</a>
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </div>
</div>