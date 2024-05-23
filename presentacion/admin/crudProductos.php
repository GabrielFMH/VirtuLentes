<?php
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';

// Conexión a la base de datos
$link = conectarse();

// Consulta para obtener todos los productos
$query = "SELECT * FROM productos";
$result = mysqli_query($link, $query);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Fancybox -->
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css" media="screen">
      
</head>
<body>
    
    <h1>Lista de Productos</h1>
    <a href="/VirtuLentes/negocio/agregarProductos.php"><button>Agregar Productos</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Modelo URL</th>
            <th>Categoría</th>
            <th class="actions">Acciones</th>
        </tr>
        
        <?php include '../../negocio/listarProductos.php'; ?>
        
    </table>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
