<?php
include 'barra_admin.php';
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';

$fechaBusqueda ='';

// Conexión a la base de datos
$link = conectarse();

// Consulta para obtener todos los productos
$query = "SELECT 
        p.id_pedido AS 'ID Pedido',
        u.nombre AS 'Nombre de Usuario',
        p.fecha_pedido AS 'Fecha de Pedido',
        SUM(dp.cantidad) AS 'Cantidad',
        p.estado AS 'Estado',
        p.fecha_entrega AS 'Fecha de Entrega',
        p.direccion AS 'Direccion'
    FROM 
        Pedidos p
    JOIN 
        Detalle_Pedido dp ON p.id_pedido = dp.id_pedido
    JOIN 
        Productos pr ON dp.id_producto = pr.id_producto
    JOIN 
        Usuarios u ON p.id_usuario = u.id_usuario
    WHERE 
        DATE(p.fecha_pedido) = '$fechaBusqueda'
    GROUP BY 
        p.id_pedido, u.nombre, p.fecha_pedido, p.estado
    ORDER BY 
        p.fecha_pedido DESC, 
        p.fecha_entrega DESC;
    ";
$result = mysqli_query($link, $query);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($link));
}
?>

<link rel="stylesheet" href="../css/correo.css">
<main>
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
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
<h1>Lista de Pedidos</h1>
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
            <th>Fecha Pedido</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Fecha Envio</th>
            <th>Direccion</th>
            <th class="actions">Acciones</th>
        </tr>
        
        <?php include '../../negocio/buscarPedidos.php'; ?>
        
    </table>

    
</body>
</main>
</html>