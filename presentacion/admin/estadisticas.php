<?php 
include 'barra_admin.php';
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';

$link = conectarse();

// Configurar la localización en español
mysqli_query($link, "SET lc_time_names = 'es_ES'");

// Consulta para ventas mensuales
$query = "SELECT MONTHNAME(fecha_pedido) AS mes, SUM(dp.cantidad * dp.precio) AS total_ventas
          FROM pedidos p
          JOIN detalle_pedido dp ON p.id_pedido = dp.id_pedido
          WHERE YEAR(fecha_pedido) = YEAR(CURDATE())
          GROUP BY MONTH(fecha_pedido)
          ORDER BY MONTH(fecha_pedido)";

$result = mysqli_query($link, $query);
$datos = array();
while($row = mysqli_fetch_assoc($result)) {
    $datos[$row['mes']] = (int)$row['total_ventas'];
}
$datos_json = json_encode($datos);

// Consulta para stock de productos
$query_stock = "SELECT nombre, stock FROM productos ORDER BY nombre";
$result_stock = mysqli_query($link, $query_stock);
$datos_stock = array();
while($row = mysqli_fetch_assoc($result_stock)) {
    $datos_stock[$row['nombre']] = (int)$row['stock'];
}
$datos_stock_json = json_encode($datos_stock);

mysqli_close($link);
?>

<main>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <!--Activar si se quiere que el fondo este blanco -->
    <!--<link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 70px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        canvas {
            width: 100%;
            height: 100%;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h2>Ventas Mensuales</h2>
        <canvas id="grafico"></canvas>
    </div>
    <div class="container">
        <h2>Stock por Producto</h2>
        <canvas id="grafico-pastel"></canvas>
    </div>

    <script>
        var datos = <?php echo $datos_json; ?>;
        var labels = Object.keys(datos);
        var valores = Object.values(datos);
        var ctx = document.getElementById('grafico').getContext('2d');
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: valores,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return 'S/. ' + value;
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'S/. ' + tooltipItem.parsed.y;
                            }
                        }
                    }
                }
            }
        });
        
        var datosStock = <?php echo $datos_stock_json; ?>;
        var labelsStock = Object.keys(datosStock);
        var valoresStock = Object.values(datosStock);
        var ctxPie = document.getElementById('grafico-pastel').getContext('2d');
        var graficoPastel = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labelsStock,
                datasets: [{
                    label: 'Stock por Producto',
                    data: valoresStock,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</body>
</main>



//script para que no se vea el tag de soles
<script>
        var datos = <?php echo $datos_json; ?>;
        var labels = Object.keys(datos);
        var valores = Object.values(datos);

        var ctx = document.getElementById('grafico').getContext('2d');
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: valores,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>