var url = "";
var $table;
$(document).ready(function () {
    


    $('form').submit(function () {
        $.gs_loader.show();
        $(this).formPost(true, {}, function (data) {
            $.gs_loader.hide();

            if (data.exito) {
                Swal.fire("", data.mensaje, "success");
                setTimeout(function () {
                    $(location).attr('href', $('#baseurl').val() + 'web/contactenos');
                }, 10000);

            } else {
                //Swal.fire("", data.mensaje, "error");
                $('.error-message-paquete').html(data.mensaje);

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
