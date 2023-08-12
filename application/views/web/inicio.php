<!-- Carousel wrapper -->
<div id="introCarousel" class=" slider carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active"></li>
        <?php
        $i = 1;
        foreach ($sliders->result() as $slider) { ?>

            <li data-mdb-target="#introCarousel" data-mdb-slide-to="<?= $i; ?>"></li>
        <?php
            $i++;
        } ?>
    </ol>


    <!-- Inner -->
    <div class=" carousel-inner">
        <!-- Single item -->
        <div class="carousel-item active">
            <div class="imagen">
                <img src="<?= base_url(); ?>/assets/web/img/banner/1.png" alt="Sunset Over the City" />
            </div>

            <div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white text-end">
                        <h1 class="mb-3 animate__animated  animate__backInDown"><a class="text-white" href="<?=base_url('web/terapias')?>">Terapias</a></h1>
                        <h1 class="mb-3 animate__animated  animate__backInDown"><a class="text-white" href="<?=base_url('web/cursos')?>">Cursos</a></h1>
                        <h1 class="mb-3 animate__animated  animate__backInDown"><a class="text-white" href="<?=base_url('web/tienda')?>">Tienda</a></h1>

                        <a class="btn btn-rounded btn-secondary btn-lg m-2 animate__animated  animate__swing animate__delay-2s" href="https://hashiko.com.pe/web/contactenos" role="button" rel="nofollow" target="_blank">Más Informacion</a>

                    </div>
                </div>
            </div>
        </div>

        <?php

        foreach ($sliders->result() as $slider) {
        ?>

            <!-- Single item -->
            <div class="carousel-item">
                <div class="imagen">
                    <img src="<?= base_url(); ?>/assets/img/upload/<?= $slider->imagen_slider; ?>" alt="Sunset Over the City" />
                </div>
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white text-end animate__animated animate__swing">
                            <h1 class="mb-3 animate__animated  animate__backInDown"><?= $slider->descripcion_slider; ?></h1>
                            <a class="btn btn-rounded btn-secondary btn-lg m-2 animate__animated  animate__swing animate__delay-2s" href="<?= $slider->link_slider; ?>" target="_blank">Más Informacion</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
    <!-- Inner -->



    <!-- Controls -->
    <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
        <img src="<?= base_url(); ?>/assets/web/img/icons/left.svg" height="28">
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
        <img src="<?= base_url(); ?>/assets/web/img/icons/right.svg" height="28">
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Carousel wrapper -->
</header>
<!--Main Navigation-->


<main class="mt-5">
    <div class="container">
        <div class="servicios animate__animated animate__fadeInDown">
            <div class="container">
                <div class="titulo">
                    <h1 class="text-center animate__animated animate__fadeInDown">¿Qué estás buscando?</h1>
                </div>
                <div class="row contenido animate__animated animate__fadeInDown">
                    <div class="item col-md-6 col-lg-3">
                        <div class="ih-item circle colored effect6 scale_up">
                            <a href="<?= base_url('web/tienda'); ?>">
                                <div class="img"><img src="<?= base_url(); ?>/assets/img/tienda.jfif" alt="img"></div>
                                <div class="info">
                                    <h3>Tienda</h3>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item col-md-6 col-lg-3">
                        <div class="ih-item circle colored effect6 scale_up">
                            <a href="<?= base_url('web/cursos'); ?>">
                                <div class="img"><img src="<?= base_url(); ?>/assets/img/cursos.jfif" alt="img"></div>
                                <div class="info">
                                    <h3>Cursos</h3>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item col-md-6 col-lg-3">
                        <div class="ih-item circle colored effect6 scale_up">
                            <a href="<?= base_url('web/terapias'); ?>">
                                <div class="img"><img src="<?= base_url(); ?>/assets/img/terapias.jfif" alt="img"></div>
                                <div class="info">
                                    <h3>Terapias</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="cursos">
            <div class="container">
                <div class="titulo animate__animated animate__fadeInDown ">
                    <h1 class="text-center text-secondary">Nuestros Cursos</h3>
                </div>
                <div class="row contenido animate__animated animate__fadeInRight ">

                    <?php foreach ($cursos->result() as $curso) {
                        $descripcion = $curso->descripcion_curso;
                        $modalidad = $curso->modalidad_curso;

                        if ($modalidad == '1') {
                            $modalidad = 'Presencial';
                            $color = "danger";
                        } elseif ($modalidad == '2') {
                            $modalidad = 'Online';
                            $color = "info";
                        } elseif ($modalidad == '3') {
                            $modalidad = 'Semipresencial';
                            $color = "warning";
                        }

                        if (strlen($descripcion) > 150) {
                            $descripcion = substr($descripcion, 0, 100);
                        }
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                <div class="hover-zoom bg-image ripple imagen" data-mdb-ripple-color="light" href="<?= base_url(); ?>">
                                    <img src="<?= base_url(); ?>/assets/img/upload/<?= $curso->imagen_curso; ?>" class=" img-fluid" />
                                    <div class="mask" style="background: linear-gradient(to bottom, hsla(0, 0%, 0%, 0) 50%,#7d72dcbe);">
                                        <div class=" d-flex justify-content-end align-items-top h-100">
                                            <p class="px-2"> <span style="font-size: 12px;" class="badge bg-<?= $color; ?>"><?= $modalidad; ?></span></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body text-center">
                                    <a href="<?= base_url('web/curso'); ?>/<?= $curso->id_curso; ?>">
                                        <h4 class="card-title"><?= $curso->nombre_curso; ?></h4>
                                    </a>

                                </div>
                                <div class="card-footer">
                                    <div class="justify-content-center text-center">
                                        <a href="<?= base_url('web/curso'); ?>/<?= $curso->id_curso; ?>" class="btn text-center btn-rounded btn-info  m-1">Más Informacion</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="text-center mt-3">
                    <a class="btn btn-lg px-5 btn-secondary btn-rounded" href="<?= base_url('web/cursos'); ?>">Más cursos</a>
                </div>
            </div>
        </div>




        <div class="tienda">
            <div class="container">
                <div class="titulo animate__animated animate__fadeInDown ">
                    <h1 class="text-center text-secondary">Tienda</h1>
                </div>


                <div class="row contenido animate__animated animate__fadeInUp ">
                    <?php foreach ($productos->result() as $producto) { ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card h-100">
                                <div class="hover-zoom bg-image ripple imagen" data-mdb-ripple-color="light" href="<?= base_url(); ?>">
                                    <img src="<?= base_url(); ?>/assets/img/upload/<?= $producto->imagen_producto; ?>" class="hover-zoom img-fluid" />
                                    <div class="mask" style="background: linear-gradient(to bottom, hsla(0, 0%, 0%, 0) 80%,#7d72dcbe);">
                                    </div>

                                </div>
                                <div class="card-body text-center">
                                    <h5 type="button" class="card-title" onclick="producto_informacion(<?= $producto->id_producto; ?>)"><?= $producto->nombre_producto; ?></h5>
                                    <p class="card-text"><?= "S/. " . $producto->precio_producto; ?></p>

                                </div>

                                <div class="card-footer">
                                    <a class="btn btn-floating btn-primary" href="<?php echo base_url('web/aagregar_carrito/' . $producto->id_producto); ?>">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>

                                    <a class="btn btn-info btn-floating" href="<?php echo base_url('web/producto/' . $producto->id_producto); ?>">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="text-center mt-3">
                    <a class="btn btn-lg px-5 btn-secondary btn-rounded" href="<?= base_url('web/tienda'); ?>">Más productos</a>
                </div>

            </div>

        </div>

    </div>


</main>

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