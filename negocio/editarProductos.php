<?php
require_once '../conexion/database.php';

// Conexión a la base de datos
$link = conectarse();

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = intval($_POST['id_producto']);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $modelo_url = $_POST['modelo_url'];
    $id_categoria = $_POST['id_categoria'];

    // Actualizar el producto en la base de datos
    $query = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, modelo_url = ?, id_categoria = ? WHERE id_producto = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 'ssdisii', $nombre, $descripcion, $precio, $stock, $modelo_url, $id_categoria, $id_producto);
    mysqli_stmt_execute($stmt);

    echo "Producto actualizado exitosamente.";
    // Redirige de vuelta a la lista de productos
    header("Location: ../presentacion/admin/crudProductos.php");
    exit();
} else {
    // Obtener los datos del producto a editar
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_producto = intval($_GET['id']);
        $query = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id_producto);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $producto = mysqli_fetch_assoc($result);

        if (!$producto) {
            die('Producto no encontrado');
        }
    } else {
        die('ID de producto inválido');
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>"><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>"><br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>"><br>
        <label for="modelo_url">Modelo URL:</label>
        <input type="text" name="modelo_url" id="modelo_url" value="<?php echo htmlspecialchars($producto['modelo_url']); ?>"><br>
        <label for="id_categoria">Categoría:</label>
        <input type="text" name="id_categoria" id="id_categoria" value="<?php echo htmlspecialchars($producto['id_categoria']); ?>"><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
