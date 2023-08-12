console.log('hola');

$.ajax({
  type: "POST",
  url: 'producto_mas_vendido',
  data: $(this).serialize(),
  success: function (response) {
    var jsonData = JSON.parse(response);

    var labels = jsonData.map(function (e) {
      return e.nombre_producto;
    });

    var data = jsonData.map(function (e) {
      return e.cantidad;
    });


    console.log(labels)
    console.log(data)
    console.log(jsonData);

    graficar(labels, data)
  }
});

$.ajax({
  type: "POST",
  url: 'venta_anual',
  data: $(this).serialize(),
  success: function (response) {
    var jsonData = JSON.parse(response);

    var data = jsonData.map(function (e) {
      return e.venta;
    });


    console.log(data)
    console.log(jsonData);

    graficar_ventas(data)
  }
});

function graficar(etiquetas, datos) {

  const ctx1 = document.getElementById('producto').getContext('2d');
  const producto = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: etiquetas,
      datasets: [{
        label: 'My First Dataset',
        data: datos,
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(255, 159, 64)'
        ],
        hoverOffset: 4
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

}

function graficar_ventas(datos) {

  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre '],
      datasets: [{
        label: 'Ventas Mensuales',
        data: datos,
        backgroundColor: [

          'rgba(255, 99, 132)',
        ],
        borderColor: [
          'rgba(255, 99, 132)',
          'rgba(54, 162, 235)',
          'rgba(255, 206, 86)',
          'rgba(75, 192, 192)',
          'rgba(153, 102, 255)',
          'rgba(255, 159, 64)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}