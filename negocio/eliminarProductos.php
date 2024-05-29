<?php
require_once '../conexion/database.php';

// Conexión a la base de datos
$link = conectarse();

// Inicializa una variable para almacenar mensajes de error
$error_message = "";

// Obtiene el ID del producto a eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    // Elimina el producto
    $query = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_producto);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirige de vuelta a la lista de productos
        header("Location: ../presentacion/admin/crudProductos.php");
        
        exit();
    } else {
        $error_message = "Error al eliminar el producto: el producto no existe.";
    }
} else {
    $error_message = "ID de producto inválido.";
}

// Cerrar la conexión a la base de datos
mysqli_close($link);

// Si hay un mensaje de error, mostrarlo después de la redirección
if ($error_message) {
    echo $error_message;
}
?>
