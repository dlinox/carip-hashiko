var url = "";
var $table;
var baseurl;


$(document).ready(function () {
    baseurl = $("#baseurl").val();
    var url = nameurl + '?json=true';

     //$('#rango').myDateRangePicker();

    function botones(id, $ar) {
        html = `
        <a href='{baseurl}terapia/reserva_crear/{id}' title="Editar Categoria" class="btn btn-warning btn-sm editar"><i class="fa fa-edit"></i></a>
        <a href='{baseurl}terapia/reserva_eliminar/{id}'title="Eliminar Categoria" class="btn btn-danger btn-sm eliminar"><i class="fa fa-trash"></i></a>`;

        html = replaceAll(html, "{baseurl}", baseurl);
        html = replaceAll(html, "{id}", id);
        $ar.append(html);

        $ar.find('.editar').click(function () {
            $(this).load_dialog({
                title: $(this).attr("title"),
                loaded: function ($dlg) {
                    $dlg.find('form').submit(function () {
                        $(this).formPost(true, {}, function (data) {

                            if (data.exito) {
                                Swal.fire("", data.mensaje, "success");
                                $dlg.find('.close').click();
                                $table.draw('page');

                            } else {
                                //Swal.fire("", data.mensaje, "error");
                                $('.error-message-paquete').html(data.mensaje);
                                $('.error-message-paquete').removeClass('hidden');

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
                        });
                        return false;
                    })
                }
            });
            return false;
        });

        $ar.find('.eliminar').click(function (e) {
            e.preventDefault();
            $this = $(this);
            $.gs_loader.show();
            $.getJSON($this.attr('href'), function (data) {
                $.gs_loader.hide();
                if (data.exito) {
                    Swal.fire(
                        'Eliminado!',
                        'Reserva eliminada correctamente',
                        'success'
                    );
                    $table.draw('page');

                }
            });


            return false;
        });
    }

    var buton = "<div class='opts'></div>";
    var selected = [];
    var cols = Array();
    cols.push({
        "data": null,
        "orderable": false,
        "width": "30",
        'render': function (data, type, full, meta) {
            if (typeof (buton) === "undefined") {
                return '<input type="checkbox">';
            } else {
                return buton;
            }
        }
    })

    $('#tablareservas').find('tr .ths').each(function (i, item) {
        cols.push({ "data": $(item).text(), className: "edit" });
    });
    console.log(cols);

    $table = $('#tablareservas').DataTable({
        dom: "<'row'<'col-sm-6 d-flex justify-content-start'f><'col-sm-6 text-right'l> <'col-sm-12  d-flex justify-content-start'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excel',
                text: '<span><i class="far fa-file-excel"></i> EXCEL</span>'
            },
            {
                extend: 'pdf',
                text: '<span><i class="far fa-file-pdf"></i> PDF</span>'
            },
            {
                extend: 'print',
                text: '<span><i class="fas fa-print"></i> IMPRIMIR</span>'
            },
        ],
        "processing": true,
        "serverSide": true,
        "bResetDisplay": true,
        "order": [
            [1, "desc"]
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
        "ajax": {
            "url": url,
            "type": "POST",
            "data": function (data) {
                return $.extend(data, $('.ocform').serializeJSON());
            }
        },
        "rowCallback": function (row, data) {
            selected.push(data.ID);

            botones(data.DT_RowId, $(row).find('td .opts'));
        },
        "drawCallback": function (settings) {
            var api = this.api();
            selected = [];
            $.each(api.rows().data(), function () {
                selected.push(this.ID);
            })
        },
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
        },
        "searching": false,
        "pageLength": 10,
        "columns": cols,
        "columnDefs": [
            {
                "targets": [1],
                "visible": true,
                "searchable": true
            }
        ]
    });

    $('.ocform input').DTFilter($table);

    $('.ocform input,.ocform select').change(function () {

        $table.draw();

        return false;
    })

    $('.crear').on('click', function () {

        $(this).load_dialog({
            title: $(this).attr("title"),
            loaded: function ($dlg) {
                $("#prueba").click(function () {
                    alert("Handler for .click() called.");
                });

                $dlg.find('form').submit(function () {



                    $(this).formPost(true, {}, function (data) {
                        if (data.exito) {
                            Swal.fire("", data.mensaje, "success");
                            $dlg.find('.close').click();
                            $table.draw('page');

                        } else {
                            $dlg.find('.error-message').html(data.mensaje);
                            $dlg.find('.error-message').show();
                        }
                    });
                    return false;
                })
            }
        });
        return false;
    })
});

