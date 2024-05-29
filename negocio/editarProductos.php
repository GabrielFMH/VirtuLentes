<?php
require_once '../conexion/database.php';

// Conexión a la base de datos
$link = conectarse();

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = intval($_POST['id_producto']);
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);
    $modelo_url = htmlspecialchars(trim($_POST['modelo_url']));
    $id_categoria = intval($_POST['id_categoria']);

    // Validar campos obligatorios
    if (empty($nombre) || empty($descripcion) || $precio <= 0 || $stock < 0 || empty($modelo_url) || $id_categoria <= 0) {
        echo "Todos los campos son obligatorios y deben tener valores válidos.";
    } else {
        // Actualizar el producto en la base de datos
        $query = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, modelo_url = ?, id_categoria = ? WHERE id_producto = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'ssdisii', $nombre, $descripcion, $precio, $stock, $modelo_url, $id_categoria, $id_producto);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Producto actualizado exitosamente.";
            // Redirige de vuelta a la lista de productos
            header("Location: ../presentacion/admin/crudProductos.php");
            exit();
        } else {
            echo "Error al actualizar el producto.";
        }
    }
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required><br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required><br>
        <label for="modelo_url">Modelo URL:</label>
        <input type="text" name="modelo_url" id="modelo_url" value="<?php echo htmlspecialchars($producto['modelo_url']); ?>" required><br>
        <label for="id_categoria">Categoría:</label>
        <input type="text" name="id_categoria" id="id_categoria" value="<?php echo htmlspecialchars($producto['id_categoria']); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($link);
?>
