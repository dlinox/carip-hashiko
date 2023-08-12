</header>

<div class="miga-pan">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('web'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary">Tienda</a></li>
                </ol>
            </nav>
        </div>
    </nav>

</div>

<div class="tienda">
    <div class="container">
        <div class="titulo animate__animated animate__fadeInDown ">
            <h1 class="text-center text-secondary">Tienda</h1>
        </div>


        <div class="row contenido animate__animated animate__fadeInUp ">
            <?php

            foreach ($productos->result() as $producto) {

            ?>
                <div class="col-md-4 col-lg-3 tarjeta py-3">
                    <div class="card h-100">
                        <div class="hover-zoom bg-image ripple imagen" data-mdb-ripple-color="light" href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>/assets/img/upload/<?= $producto->imagen_producto; ?>" class=" img-fluid" />
                            <div class="mask" style="background: linear-gradient(to bottom, hsla(0, 0%, 0%, 0) 85%,#7d72dcbe);">
                            </div>

                        </div>

                        <div class="card-body">
                            <h5 type="button" class="card-title" onclick="producto_informacion(<?= $producto->id_producto; ?>)"><?= $producto->nombre_producto; ?></h5>
                            <p class="card-text"><?= "S/. " . $producto->precio_producto; ?></p>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-floating btn-primary" href="<?php echo base_url('web/aagregar_carrito/' . $producto->id_producto.'/1/'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                            </a>

                            <a class="btn btn-info btn-floating" href="<?php echo base_url('web/producto/' . $producto->id_producto); ?>">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>

</div>



<!-- Modal -->
<div class="modal fade modal-producto" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <!-- card left -->
                    <div class="product-imgs">
                        <div class="img-display">
                            <div id="img-showcase" class="img-showcase hover-zoom">
                            </div>
                        </div>
                        <div id="img-select" class="img-select">
                            <div class="img-item">
                                <a href="#" data-id="1">
                                    <img height="80px" id="imagen11_producto" src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg">
                                </a>
                            </div>
                            <div class="img-item">
                                <a href="#" data-id="2">
                                    <img height="80px" id="imagen21_producto" src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg">
                                </a>
                            </div>

                        </div>

                    </div>
                    <!-- card right -->
                    <div class="product-content">
                        <h2 class="text-dark fw-bold pt-3" id="nombre_producto">nike shoes</h2>
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button id="presentacion_producto" class="btn-sm nav-link active" id="pills-home-tab2" data-mdb-toggle="pill" data-mdb-target="#pills-home2" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                    590 ml
                                </button>
                            </li>
                            <li id="info2" class="nav-item" role="presentation">
                                <button id="presentacion2_producto" class="btn-sm nav-link" id="pills-profile-tab2" data-mdb-toggle="pill" data-mdb-target="#pills-profile2" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    200 g
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-home2" role="tabpanel" aria-labelledby="pills-home-tab2">


                                <div class="product-price">
                                    <p class="new-price">Precio: <span id="precio_producto">ss</span></p>
                                </div>
                                <div class="product-detail">
                                    <p id="descripcion_producto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eveniet veniam tempora fuga tenetur placeat sapiente architecto illum soluta consequuntur, aspernatur quidem at sequi ipsa!</p>
                                    <ul>
                                        <li>Beneficio: <span id="beneficio_producto">Black</span></li>

                                    </ul>
                                </div>


                                <div class="purchase-info">
                                    <a id="btncarrito"></a>
                                    <a id="btninformacion"></a>
                                    <a id="btnwhatsapp"></a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab2">


                                <div class="product-price">
                                    <p class="new-price">Precio: <span id="precio2_producto">ss</span></p>
                                </div>
                                <div class="product-detail">
                                    <p id="descripcion2_producto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eveniet veniam tempora fuga tenetur placeat sapiente architecto illum soluta consequuntur, aspernatur quidem at sequi ipsa!</p>
                                    <ul>
                                        <li>Beneficio: <span id="beneficio2_producto">Black</span></li>

                                    </ul>
                                </div>


                                <div class="purchase-info">
                                    <a id="btncarrito2"></a>
                                    <a id="btninformacion2"></a>
                                    <a id="btnwhatsapp2"></a>
                                </div>
                            </div>

                        </div>




                    </div>
                </div>
            </div>

        </div>
    </div>
</div>