
var save_method; //for save method string
var table;

$(document).ready(function () {

    console.log(baseurl);

    //datatables
    table = $('#table').DataTable({
        dom: "<'row'<'col-sm-6 d-flex justify-content-start'f><'col-sm-6 text-right'l> <'col-sm-12  d-flex justify-content-start'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excel',
                text: '<span><i class="far fa-file-excel fw-light"></i> Excel</span>'
            },
            {
                extend: 'pdf',
                text: '<span><i class="far fa-file-pdf fw-light"></i> Pdf</span>'
            },
            {
                extend: 'print',
                text: '<span><i class="fas fa-print fw-light"></i> Imprimir</span>'
            },
        ],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            },
            {
                "targets": [-2], //2 last column (photo)
                "orderable": false, //set not orderable
            },
        ],

        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ por página",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        }

    });


});



function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Nuevo Producto'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal
    $('#label-photo').text('Subir Imagen 1'); // label photo upload
    $('#photo-preview2').hide(); // hide photo preview modal
    $('#label-photo2').text('Subir Imagen 2'); // label photo upload
}

function edit_person(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url: "ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

            $('[name="id"]').val(data.id_producto);
            $('[name="nombre"]').val(data.nombre_producto);
            $('[name="descripcion"]').val(data.descripcion_producto);
            $('[name="beneficio"]').val(data.beneficio_producto);
            $('[name="inicio"]').val(data.inicio_producto);
            $('[name="presentacion"]').val(data.presentacion_producto);
            $('[name="precio"]').val(data.precio_producto);
            $('[name="presentacion2"]').val(data.presentacion2_producto);
            $('[name="precio2"]').val(data.precio2_producto);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Producto'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if (data.imagen_producto) {

                console.log("si");
                $('#label-photo').text('Cambiar imagen 1'); // label photo upload
                $('#photo-preview div').html('<img src="' + baseurl + '/assets/img/upload/' + data.imagen_producto + '" class="img-fluid imagenformulario">'); // show photo
                $('#photo-preview div').append('<input type="checkbox"  name="remove_photo" value="' + data.imagen_producto + '"/> Eliminar Imagen 1'); // remove photo

            }
            else {
                console.log("No imagen 1");
                $('#label-photo').text('Subir Imagen 1'); // label photo upload
                $('#photo-preview div').text('(No Hay Imagen 1)');
            }

            if (data.imagen2_producto) {

                console.log("si");
                $('#label-photo2').text('Cambiar imagen 2'); // label photo upload
                $('#photo-preview2 div').html('<img src="' + baseurl + '/assets/img/upload/' + data.imagen2_producto + '" class="img-fluid imagenformulario">'); // show photo
                $('#photo-preview2 div').append('<input type="checkbox"  name="remove_photo2" value="' + data.imagen2_producto + '"/> Eliminar Imagen 2'); // remove photo

            }
            else {
                console.log("No Imagen 2");
                $('#label-photo2').text('Subir Imagen 2'); // label photo upload
                $('#photo-preview2 div').text('(No Hay Imagen 2)');
            }



        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}

function save() {
    /*$('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    */
    var url;

    if (save_method == 'add') {
        url = "ajax_add";
    } else {
        url = "ajax_update";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            if (data.status) {
                Swal.fire("", data.mensaje, "success");
                $('#modal_form').modal('hide');
                reload_table();
            }
            else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'error',
                    title: data.mensaje
                });

            }

        }
    });
}
function delete_person(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "ajax_delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    //if success reload ajax table
                    Swal.fire(
                        'Eliminado!',
                        'Se a eliminado con exito',
                        'success'
                    )
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }

    })

}