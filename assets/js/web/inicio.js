var url = "";
var $table;
var baseurl;


function producto_informacion(id) {
    /*
    const mimodal = document.getElementById('modalProducto')
    const modal = new mdb.Modal(mimodal)
    modal.show()
*/




    //Ajax Load data from ajax
    $.ajax({
        url: "web/producto_informacion/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {


            //$('#modalProducto').modal('show');

            //const mimodal = document.getElementById('modalProducto')
            //const modal = new mdb.Modal(mimodal)
            //modal.show()
            const mimodal = new mdb.Modal(document.getElementById('modalProducto'), function (event) {

            })
            var imagen2 = null;
            console.log('asdasd');

            $('[name="nombre"]').val(data.nombre_producto);
            $('#nombre_producto').html(data.nombre_producto);
            $('#presentacion_producto').html(data.presentacion_producto);
            $('#presentacion2_producto').html(data.presentacion2_producto);
            $('#dpresentacion_producto').html(data.presentacion_producto);
            $('#dpresentacion2_producto').html(data.presentacion2_producto);
            $('#precio_producto').html('S/. ' + data.precio_producto);
            $('#precio2_producto').html('S/. ' + data.precio2_producto);
            $('#descripcion_producto').html(data.descripcion_producto);
            $('#descripcion2_producto').html(data.descripcion_producto);
            $('#beneficio_producto').html(data.beneficio_producto);
            $('#beneficio2_producto').html(data.beneficio_producto);

            $('#btncarrito').html("<a class='mt-2 btn btn-floating btn-primary' href='" + baseurl + "web/aagregar_carrito/" + data.id_producto + "/1'><i class='fas fa-shopping-cart'></i></a>");
            $('#btnwhatsapp').html("<a class='mt-2 btn btn-rounded btn-success' href='https://wa.me/+51999978644/?text=%0A%20%20%20%20%20%20%20%20%20%20VENTA DE PRODUCTO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRE:%20%20%20" + data.nombre_producto + "%0A%20%20%20PRESENTACION:%20%20%20" + data.presentacion_producto + "' target='_blank'" + " > Comprar por Whatsapp</a > ");
            $('#btninformacion').html("<a class='mt-2 btn btn-floating btn-info' href='" + baseurl + "web/producto/" + data.id_producto + "'><i class='fas fa-search'></i></a>");


            var imagen2 = data.imagen2_producto;
            if (imagen2 == null) {
                console.log("nulo");
                $('#img-showcase').html("<img src='" + baseurl + 'assets/img/upload/' + data.imagen_producto + "'>");
                /*$('#img-select').html("<div class='img-item'><a href='#' data-id='1'><img height='80px' src='" + baseurl + 'assets/img/upload/' + data.imagen_producto + "'></a></div > "); */
                $("#imagen21_producto").attr("src", baseurl + 'assets/img/boxed-bg.png');
                $('#precio2_producto').html('S/. ' + data.precio_producto);
            }
            else {
                $('#img-showcase').html("<img src='" + baseurl + 'assets/img/upload/' + data.imagen_producto + "'><img src='" + baseurl + 'assets/img/upload/' + data.imagen2_producto + "'>");
                /*$('#img-select').html("<div class='img-item'><a href='#' data-id='1'><img height='80px' src='" + baseurl + 'assets/img/upload/' + data.imagen_producto + "'></a></div><div class='img-item'><a href='#' data-id='2'><img height='80px' src='" + baseurl + 'assets/img/upload/' + data.imagen2_producto + "'></a></div>");*/
                $("#imagen21_producto").attr("src", baseurl + 'assets/img/upload/' + data.imagen2_producto);
                $('#btncarrito').html("<a class='mt-2 btn btn-floating btn-primary' href='" + baseurl + "web/aagregar_carrito/" + data.id_producto + "/1'><i class='fas fa-shopping-cart'></i></a>");
                $('#btnwhatsapp').html("<a class='mt-2 btn btn-rounded btn-success' href='https://wa.me/+51999978644/?text=%0A%20%20%20%20%20%20%20%20%20%20VENTA DE PRODUCTO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRE:%20%20%20" + data.nombre_producto + "%0A%20%20%20PRESENTACION:%20%20%20" + data.presentacion_producto + "' target='_blank'" + " > Comprar por Whatsapp</a > ");
                $('#btninformacion').html("<a class='mt-2 btn btn-floating btn-info' href='" + baseurl + "web/producto/" + data.id_producto + "'><i class='fas fa-search'></i></a>");

                $('#btncarrito2').html("<a class='mt-2 btn btn-floating btn-primary' href='" + baseurl + "web/aagregar_carrito/" + data.id_producto + "/2'><i class='fas fa-shopping-cart'></i></a>");
                $('#btnwhatsapp2').html("<a class='mt-2 btn btn-rounded btn-success' href='https://wa.me/+51999978644/?text=%0A%20%20%20%20%20%20%20%20%20%20VENTA DE PRODUCTO%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRE:%20%20%20" + data.nombre_producto + "%0A%20%20%20PRESENTACION:%20%20%20" + data.presentacion_producto + "' target='_blank'" + " > Comprar por Whatsapp</a > ");
                $('#btninformacion2').html("<a class='mt-2 btn btn-floating btn-info' href='" + baseurl + "web/producto/" + data.id_producto + "'><i class='fas fa-search'></i></a>");

            }
            console.log(imagen2);
            $("#imagen_producto").attr("src", baseurl + 'assets/img/upload/' + data.imagen_producto);
            $("#imagen2_producto").attr("src", baseurl + 'assets/img/upload/' + data.imagen2_producto);
            $("#imagen11_producto").attr("src", baseurl + 'assets/img/upload/' + data.imagen_producto);

            mimodal.show();




        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });




}
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage() {
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);