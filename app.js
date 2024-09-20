// Seleccionamos los elementos necesarios
const hamburgerMenu = document.querySelector('.hamburger-menu');
const sidebar = document.querySelector('.sidebar');

// Agregamos el evento para abrir/cerrar el sidebar
hamburgerMenu.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});


// Datos numéricos
// Obtén el elemento que contiene el valor del gasto
const totalGastoElement = document.querySelector('.total_gasto');
const totalIngresoElement = document.querySelector('.total_ingreso');

// Obtén el valor de texto dentro del elemento (ej: "$123.45")
const totalGastoTexto = totalGastoElement.textContent;
const totalIngresoTexto = totalIngresoElement.textContent;

// Elimina el símbolo de dólar y convierte el valor a número
const totalGastoNumerico = parseFloat(totalGastoTexto.replace('$', ''));
const totalIngresoNumerico = parseFloat(totalIngresoTexto.replace('$', ''));

const data1 = totalGastoNumerico;
const data2 = totalIngresoNumerico;

// Obtener el contexto del canvas donde se mostrará la gráfica
const ctx = document.getElementById('myChart').getContext('2d');

// Crear la gráfica usando Chart.js
const myChart = new Chart(ctx, {
    type: 'bar', // Tipo de gráfica
    data: {
        labels: ['Gastos', 'Ingresos'], // Etiquetas para los datos
        datasets: [{
            label: 'Comparación de ingresos y gastos', // Etiqueta de la gráfica
            data: [data1, data2], // Valores para los dos datos
            backgroundColor: [
                'rgba(213, 19, 203,0.2)',
                'rgba(54, 162, 235, 0.2)' // Color de fondo para el dato 1
                  // Color de fondo para el dato 2
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',   // Color de borde para el dato 1
                'rgba(54, 162, 235, 1)'    // Color de borde para el dato 2
            ],
            borderWidth: 1 // Ancho del borde
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true // Comenzar la escala desde cero
            }
        }
    }
});



const button_gastos = document.querySelector(".button_gastos");
button_gastos.submit(window.location = "index.php")