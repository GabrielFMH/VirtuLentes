<?php
include 'barra_admin.php';
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';

$searchTerm ='';
if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

    // Conectarse a la base de datos
    $link = conectarse();

    $query = "SELECT
    p.id_pedido AS 'ID Pedido',
    u.nombre AS 'Nombre de Usuario',
    p.fecha_pedido AS 'Fecha de Pedido',
    pr.nombre AS 'Nombre de Producto',
    dp.cantidad AS 'Cantidad',
    dp.precio AS 'Precio Unitario',
    dp.cantidad * dp.precio AS 'Precio Total Producto',  
    SUM(dp.cantidad * dp.precio) OVER (PARTITION BY p.id_pedido) AS 'Precio Total Pedido',
    p.estado AS 'Estado'
FROM 
    Pedidos p
JOIN 
    Detalle_Pedido dp ON p.id_pedido = dp.id_pedido
JOIN 
    Productos pr ON dp.id_producto = pr.id_producto
JOIN 
    Usuarios u ON p.id_usuario = u.id_usuario
WHERE 
    p.id_pedido = '$id_pedido'
";

    $result = mysqli_query($link, $query);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($link));
    }
} else {
    echo "No se ha proporcionado un ID de pedido válido.";
    exit;
}
?>

<main>
<head>
    <meta charset="UTF-8">
    <title>Ver Detalle de Pedido</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
   
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
  
    <!-- Tabla -->
    <link rel="stylesheet" href="../css/table.css">  

</head>

<body>
    <h1>Detalle de Pedido</h1>
    <br>
    <style>
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0; /* Margen en la parte superior e inferior de la tabla */
            font-size: 14px; /* Tamaño de fuente para los datos de la tabla */
        }

        table, th, td {
            border: 1px solid #ddd; /* Borde delgado alrededor de la tabla y las celdas */
            padding: 8px; /* Espaciado interno en las celdas */
            text-align: left; /* Alineación del texto a la izquierda en las celdas */
        }

        th {
            background-color: #f2f2f2; /* Color de fondo para las celdas de encabezado */
            color: #333; /* Color de texto oscuro para las celdas de encabezado */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Color de fondo alternativo para filas pares */
        }

    .tabla-container {
        width: 80%;
        margin: 0 auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #dddddd;
    }
    th {
        background-color: #f2f2f2;
        text-align: center; /* Centra el texto en los encabezados */
    }
    td {
        background-color: #ffffff;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    </style>
    <button class="btn btn-secondary" onclick="window.location.href = 'index.php';">Volver a Pedidos</button>
    <br><br>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>Nombre de Usuario</th>
            <th>Fecha de Pedido</th>
            <th>Nombre de Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Unitario Total</th>
            <th>Precio Total Pedido</th>
            <th>Estado</th>
        </tr>
        
        <?php include '../../negocio/verDetalleProducto.php'; ?>
        
    </table>
</body>
</main>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
