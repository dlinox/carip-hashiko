var url = "";
var $table;
var baseurl;

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        dateClick: function () {
            alert('a day has been clicked!');
        },
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timelineDay,dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        
    }
    );
    calendar.render();
});


$(document).ready(function () {
    baseurl = $("#baseurl").val();
    var url = nameurl + '?json=true';

    // $('#rango').myDateRangePicker();

    function botones(id, $ar) {
        html = `
        <a href='{baseurl}hotel/categoria_crear/{id}' title="Editar Categoria" class="btn btn-primary btn-sm editar"><i class="fa fa-edit"></i></a>
        <a href='{baseurl}hotel/categoria_eliminar/{id}'title="Eliminar Categoria" class="btn btn-danger btn-sm eliminar"><i class="fa fa-trash"></i></a>`;

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
                                $dlg.find('.error-message').html(data.mensaje);
                                $dlg.find('.error-message').show();
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
            Swal.fire({
                title: 'Estás seguro de eliminar?',
                text: "Está accion no podrá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: "Cancelar"
            }, function () {
                $.gs_loader.show();
                $.getJSON($this.attr('href'), function (data) {
                    $.gs_loader.hide();
                    if (data.exito) {
                        Swal.fire("", data.mensaje, "success");
                        $table.draw('page');
                        totales();
                    } else
                        Swal.fire("", data.mensaje, "info");
                });
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

    $('#mitabla').find('tr .ths').each(function (i, item) {
        cols.push({ "data": $(item).text(), className: "edit" });
    });
    console.log(cols);

    $table = $('#mitabla').DataTable({
        /*dom: "<'row'<'col-sm-6 col-lg-8'B><'col-sm-6 col-lg-4 text-right'lf>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>", */
        dom: "Blftrip",
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
        totales();
        return false;
    })

    totales();


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
                            totales();
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

function totales() {
    form = $(".ocform");
    $.ajax({
        dataType: "json",
        method: "POST",
        url: baseurl + "Contabilidad/getresumenmensual",
        data: form.serialize(),
        success: function (resp) {
            var pagopersonal = parseFloat(resp.pagopersonal.egresopagopersonal);
            var flujocaja = parseFloat(resp.flujocaja.egresoflujocaja);
            var pagosalumnos = parseFloat(resp.pagos.ingresopagos);
            if (isNaN(pagopersonal)) {
                pagopersonal = 0;
            }
            if (isNaN(flujocaja)) {
                flujocaja = 0;
            }
            if (isNaN(pagosalumnos)) {
                pagosalumnos = 0;
            }
            console.log("Pagoperosnal: ", pagopersonal);
            console.log("flujocaja: ", flujocaja);
            console.log("pagos: ", pagosalumnos);

            var egresoflujocaja = 0;

            egresoflujocaja = flujocaja;

            console.log(egresoflujocaja);

            $('.egresoflujocaja').html(egresoflujocaja.toFixed(2));
        }
    });

};
