<?php
ob_start();
include 'barra_admin.php';
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';
$searchTerm ='';
$link = conectarse();
$query = "SELECT `id_pedido`, `id_usuario`, `fecha_pedido`, `estado`, `fecha_entrega`, `direccion` FROM pedidos";
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/table.css">     
</head>
<h1>Lista de Pedidos</h1>
<style>
    table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0; 
            font-size: 14px; 
    }
    table, th, td {
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
    }
    th {
            background-color: #f2f2f2; 
            color: #333; 
    }
    tr:nth-child(even) {
            background-color: #f9f9f9; 
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
        text-align: center; 
    }
    td {
        background-color: #ffffff;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    </style>
    <br>
    <form method="POST" action="crudBuscarPedido.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Buscar pedidos" aria-label="Buscar" value="<?php echo htmlspecialchars($searchTerm); ?>"required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
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
        
        <?php include '../../negocio/agregarEnvio.php'; ob_end_flush();?>
        
    </table>
</body>
</main>
</html>