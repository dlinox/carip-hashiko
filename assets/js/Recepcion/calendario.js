$('#calendario').fullCalendar({

    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
    locale: 'es',
    themeSystem: 'bootstrap4',


    /**Configuracion */
    now: new Date(),
    timeZone: 'UTC',
    editable: true,
    selectable: true,
    nowIndicator: true,
    displayEventEnd: {
        month: true,
        basicWeek: true,
        "default": true
    },



    defaultView: 'timelineMonth',
    header: {
        left: 'prev,next, today',
        center: 'title',
        right: 'timelineDay,customWeek,timelineMonth,listWeek'
    },
    views: {
        timelineDay: {
            type: 'timeline',
            slotLabelFormat: ['hh:mm a'],
            timeFormat: 'H(:mm)t',
        },
        customWeek: {
            type: 'timeline',
            duration: {
                weeks: 1
            },
            slotDuration: {
                days: 1
            },
            buttonText: 'Semana'
        }

    },
    resourceAreaWidth: '13%',
    resourceColumns: [
        {
            labelText: 'Habitacion',
            field: 'title'
        },
        {
            labelText: 'Tipo',
            field: 'sigla'
        }
    ],
    select: function (startDate, endDate, mjsEvent, view, resource) {


        var fechaHora = startDate.format().split("T");
        var fechaHoraEnd = endDate.format().split("T");

        var check = moment(startDate).format('YYYY-MM-DD');
        var today = moment(new Date()).format('YYYY-MM-DD');


        $('#txtDate').val(fechaHora[0]);
        $('#txtHour').val(fechaHora[1]);

        $('#txtDateEnd').val(fechaHoraEnd[0]);
        $('#txtHourEnd').val(fechaHoraEnd[1]);
        $('#id_habitacion').val(resource.id);

        /** Agregar */

        $('#txtDateadd').val(fechaHora[0]);
        $('#txtHouradd').val(fechaHora[1]);

        $('#txtDateEndadd').val(fechaHoraEnd[0]);
        $('#txtHourEndadd').val(fechaHoraEnd[1]);
        $('#id_habitacionadd').val(resource.id);


        if (check >= today) {
            alert(check);
        } else {
            Swal.fire({
                title: "Error!",
                text: "No se puede hacer una reserva para una fecha pasada",
                icon: "error",
                button: "Aceptar",
                dangerMode: true
            });
        }

    },
    resources: 'calendario_habitacion',
    events: 'calendario_reserva',

    eventRender: function (calEvent, element) {
        if (calEvent.tipo == '1') {
            element.css({
                'border': 'none',
                'font-weight': 'bolder',
                'text-transform': 'capitalize'
            });
            element.popover({
                title: calEvent.title,
                content: "Telefono: " + calEvent.tipo,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        }
        if (calEvent.tipo == '2') {
            element.css({
                'border': 'none',
                'font-weight': 'bolder',
                'text-transform': 'capitalize'
            });

        }
    }
    /*resources: [
        { id: 'a', title: 'A', occupancy: 40 },
        { id: 'b', title: 'B', occupancy: 40, eventColor: 'green' },
        { id: 'c', title: 'C', occupancy: 40, eventColor: 'orange' },
        {
            id: 'd', title: 'D', occupancy: 40, children: [
                { id: 'd1', title: 'D1', occupancy: 10 },
                { id: 'd2', title: 'D2', occupancy: 10 }
            ]
        },
        { id: 'e', title: 'E', occupancy: 40 },
        { id: 'f', title: 'F', occupancy: 40, eventColor: 'red' },
        { id: 'g', title: 'G', occupancy: 40 },
        { id: 'h', title: 'H', occupancy: 40 },
        { id: 'i', title: 'I', occupancy: 40 },
        { id: 'j', title: 'J', occupancy: 40 },
        { id: 'k', title: 'K', occupancy: 40 },
        { id: 'l', title: 'L', occupancy: 40 },
        { id: 'm', title: 'M', occupancy: 40 },
    ],
    */
    /*
    events: [
        { id: '1', resourceId: 'b', start: '2022-03-05T02:00:00', end: '2022-03-07T07:00:00', title: 'event 1' },
        { id: '2', resourceId: 'c', start: '2022-03-07T05:00:00', end: '2022-03-08T22:00:00', title: 'event 2' },
        { id: '3', resourceId: 'd', start: '2022-03-06', end: '2022-03-08', title: 'event 3' },
        { id: '4', resourceId: 'e', start: '2022-03-08T03:00:00', end: '2022-03-11T08:00:00', title: 'event 4' },
        { id: '5', resourceId: 'f', start: '2022-03-07T00:30:00', end: '2022-03-09T02:30:00', title: 'event 5' }
    ]
    */
});