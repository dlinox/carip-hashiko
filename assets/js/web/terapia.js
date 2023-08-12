console.log("Hola");

$('input[name="fecha"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  minYear: 1901,
  maxYear: parseInt(moment().format('YYYY'), 10),
  locale: {
    format: 'DD/MM/YYYY'
  }
});

function isMobile() {
  if (sessionStorage.desktop)
    return false;
  else if (localStorage.mobile)
    return true;
  var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
  for (var i in mobile)
    if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
  return false;
}

const formulario = document.querySelector('#formulario');
const buttonSubmit = document.querySelector('#submit');
const urlDesktop = 'https://web.whatsapp.com/';
const urlMobile = 'whatsapp://';
const telefono = '+51999978644';

formulario.addEventListener('submit', (event) => {
  event.preventDefault()
  buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
  buttonSubmit.disabled = true
  setTimeout(() => {
    let nombre = document.querySelector('#nombres').value
    let dni = document.querySelector('#dni').value
    let correo = document.querySelector('#correo').value
    let terapia = document.querySelector('#terapia').value
    let fecha = document.querySelector('#fecha').value
    let hora = document.querySelector('#hora').value

    let mensaje = 'send?phone=' + telefono + '&text=%0A%20%20%20%20%20%20%20%20%20%20RESERVA DE TERAPIA%20%20%20%20%20%20%20%20%20%0A+---------------------------------------+%0A%20%20%20NOMBRES:%20%20%20' + nombre + '%0A%20%20%20DNI%20%20%20%20%20%20%20%20%20%20:%20%20%20%20' + dni + '%0A%20%20%20CORREO%20%20:%20%20%20%20' + correo + '%0A%20%20%20TERAPIA%20%20:%20%20%20%20' + terapia + '%0A%20%20%20FECHA%20%20%20%20%20:%20%20%20%20' + fecha + '%0A%20%20%20HORA%20%20%20%20%20%20:%20%20%20%20' + hora + ''
    if (isMobile()) {
      window.open(urlMobile + mensaje, '_blank')
    } else {
      window.open(urlDesktop + mensaje, '_blank')
    }
    buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
    buttonSubmit.disabled = false
  }, 1000);
});

