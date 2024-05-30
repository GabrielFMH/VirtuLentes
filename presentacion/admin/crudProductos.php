<?php
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';
$searchTerm ='';


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
<?php include 'navbarAdmin.php'; ?>
    <br><br><br><br>
    <h1>Lista de Productos</h1>
    <br><br>
    <a href="/VirtuLentes/negocio/agregarProductos.php"><button class="btn btn-outline-success my-2 my-sm-0">Agregar Productos</button></a>
    <!-- Barra de búsqueda -->
    <form method="POST" action="../../negocio/buscarProductos.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Buscar productos" aria-label="Buscar" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
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
