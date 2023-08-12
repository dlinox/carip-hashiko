var url = "";
var $table;
var baseurl;
$(document).ready(function () {
    baseurl = $("#baseurl").val();
    var url = nameurl + '?json=true';

    // $('#rango').myDateRangePicker();

    function botones(id, $ar) {
        html = `
        <a href='{baseurl}configuracion/tipo_producto_crear/{id}' title="Editar Producto" class="btn btn-primary btn-sm editar"><i class="fa fa-edit"></i></a>
        <a href='{baseurl}configuracion/tipo_producto_eliminar/{id}'title="Eliminar Producto" class="btn btn-danger btn-sm eliminar"><i class="fa fa-trash"></i></a>`;

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
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    $table.draw('page');

                }
            });


            return false;
        });
    }

    function updateBarra(row, data) {

        //console.log(data.DT_CUOTAS);
        //console.log(data.PAGADO);
        //console.log(data.DEUDA);
        //console.log(data.DT_COSTO);

        var costocuota = data.DT_COSTO / data.DT_CUOTAS;

        var cuotaspagadas = data.PAGADO / costocuota;
        //console.log("Pag:  ",cuotaspagadas);

        if (data.DT_es_becado == '1') {
            cuotaspagadas = data.DT_CUOTAS;
        }

        var iconos = "";

        for (let i = 0; i < data.DT_CUOTAS; i++) {

            if (cuotaspagadas > 0) {
                iconos = iconos + "<span class='pull-right badge bg-green'>-</span>";

                cuotaspagadas--;
            }
            else {
                iconos = iconos + "<span class='pull-right badge bg-red'>-</span>";
            }
        }

        //console.log("Iconos",iconos);

        var $icon = $(row).find('div.iconos'), $td = $icon.parent(), value = $icon.text();
        $td.empty();

        $td.html(iconos);



        var $barra = $(row).find('div.barra'), $td = $barra.parent(), value = $barra.text();
        $td.empty();
        if (data.DT_es_becado == '1') {
            $td.html('<span class="label label-info">BECADO</span>');
        }
        else {
            if (data.DEUDA <= 0) {
                $td.html('<span class="label label-success">PAGO COMPLETO</span>');
            }
            else {
                $('#tmpl-barra-progreso').tmpl({ value: value }).appendTo($td);
            }
        }
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

    $('#mitabla').find('tr .ths').each(function (i, item) {
        cols.push({ "data": $(item).text(), className: "edit" });
    });
    console.log(cols);

    $table = $('#mitabla').DataTable({
        dom: "<'row'<'col-sm-6 col-lg-8'B><'col-sm-6col-lg-4 text-right'lf>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excel',
                text: '<span><i class="fa fa-file-excel-o"></i> EXCEL</span>'
            },
            {
                extend: 'pdf',
                text: '<span><i class="fas fa-file-pdf-o"></i> PDF</span>'
            },
            {
                extend: 'print',
                text: '<span><i class="fa fa-print"></i> IMPRIMIR</span>'
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
    });

    $('.crear').on('click', function () {
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
    })
});

