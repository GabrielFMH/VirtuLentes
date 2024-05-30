<?php

// Incluir el archivo de conexión
include '../conexion/database.php';

// Iniciar la conexión
$link = conectarse();

// Verificar la conexión
if (!$link) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Inicializar variables
$searchTerm = '';
$result = null;

// Si se envió el formulario de búsqueda
if(isset($_POST['search'])){
    // Obtener el término de búsqueda
    $searchTerm = mysqli_real_escape_string($link, $_POST['search']);

    // Consulta SQL para buscar productos por nombre
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$searchTerm%'";

    // Ejecutar la consulta
    $result = mysqli_query($link, $query);

    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($link));
    }
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
    <br><br><br><br>
    <h1>Lista de Productos</h1>
    <br><br>
    <!-- Barra de búsqueda -->

    <br><br>
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
        
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["id_producto"] . '</td>';
                echo '<td>' . $row["nombre"] . '</td>';
                echo '<td>' . $row["descripcion"] . '</td>';
                echo '<td>' . $row["precio"] . '</td>';
                echo '<td>' . $row["stock"] . '</td>';
                echo '<td>' . $row["modelo_url"] . '</td>';
                echo '<td>' . $row["id_categoria"] . '</td>';
                echo '<td class="actions">
                <a href="/VirtuLentes/negocio/editarProductos.php?id=' . $row['id_producto'] . '">Editar</a> |
                <a href="/VirtuLentes/negocio/eliminarProductos.php?id=' . $row['id_producto'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este producto?\');">Eliminar</a>
            </td>';
            echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8">No se encontraron resultados.</td></tr>';
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
