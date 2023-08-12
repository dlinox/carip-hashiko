var url = "";
var $table;
$(document).ready(function () {
    /*$('form').submit(function (ev) {
        $.ajax({
            type: $('form').attr('method'),
            url: $('form').attr('action'),
            data: $('form').serialize(),
            success: function (data) {
                if (data.exito) {
                    Swal.fire("", data.mensaje, "success");
                    setTimeout(function () {
                        $(location).attr('href', $('#baseurl').val() + 'web/');
                    }, 1000);
                    $('.error-message-paquete').addClass('hidden');

                } else {
                    Swal.fire("", data.mensaje, "error");
                    $('.error-message-paquete').html(data.mensaje);
                    $('.error-message-paquete').removeClass('hidden');
                }
                alert(data.mensaje);
                Swal.fire("Hola","asda", "success");
            }
        });
        ev.preventDefault();
    });
    */

    
    $('form#form-1').submit(function () {
        $.gs_loader.show();
        $(this).formPost(true, {}, function (data) {
            $.gs_loader.hide();

            if (data.exito) {
                Swal.fire("", data.mensaje, "success");
                setTimeout(function () {
                    $(location).attr('href', $('#baseurl').val() + 'web/cursos');
                }, 10000);
                $('.error-message-paquete').addClass('hidden');

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
    });


});
