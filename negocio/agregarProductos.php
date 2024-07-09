<?php
require_once '../conexion/database.php';

// Conexión a la base de datos
$link = conectarse();

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $modelo_url = $_POST['modelo_url'];
    $id_categoria = $_POST['id_categoria'];

    // Insertar el nuevo producto en la base de datos
    $query = "INSERT INTO productos (nombre, descripcion, precio, stock, modelo_url, id_categoria) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssdisi', $nombre, $descripcion, $precio, $stock, $modelo_url, $id_categoria);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Producto agregado exitosamente.";
        // Redirige de vuelta a la lista de productos
        header("Location: ../presentacion/admin/crudProductos.php");
        exit();
    } else {
        echo "Error al agregar el producto.";
    }
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión a la base de datos
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="../presentacion/css/bootstrap.min.css">
   
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="../presentacion/css/responsive.css">
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="../presentacion/css/jquery.mCustomScrollbar.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../presentacion/css/font-awesome.min.css">
 
   <!-- Tabla -->
   <link rel="stylesheet" href="../presentacion/css/table.css">  
</head>
<body>
    <?php include '../presentacion/admin/barra_admin.php'; ?>

 
    <div class="form-container">
        <h1>Agregar nuevo producto:</h1>
        <form action="agregarProducto.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" required>
            
            <label for="stock">Stock:</label>
            <input type="text" id="stock" name="stock" required>
            
            <label for="modelo_url">Modelo URL:</label>
            <input type="text" id="modelo_url" name="modelo_url">
            
            <label for="id_categoria">Categoría:</label>
            <input type="text" id="id_categoria" name="id_categoria" required>
            
            <button type="submit">Agregar Producto</button>
        </form>
    </div>
</body>
</html>
