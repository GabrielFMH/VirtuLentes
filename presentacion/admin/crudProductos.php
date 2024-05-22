<?php
require_once 'database.php';

// Conexión a la base de datos
$db = Database::getInstance();
$pdo = $db->getConnection();

// Consulta para obtener todos los productos
$query = "SELECT * FROM productos";
$stmt = $pdo->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>

</head>
<body>
    <h1>Lista de Productos</h1>
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
        <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
            <td><?php echo htmlspecialchars($producto['stock']); ?></td>
            <td><?php echo htmlspecialchars($producto['modelo_url']); ?></td>
            <td><?php echo htmlspecialchars($producto['id_categoria']); ?></td>
            <td class="actions">
                <a href="editar.php?id=<?php echo $producto['id_producto']; ?>">Editar</a> |
                <a href="eliminar.php?id=<?php echo $producto['id_producto']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
