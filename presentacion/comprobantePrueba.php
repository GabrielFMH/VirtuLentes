<?php
session_start();

// Verificar si la sesión del usuario está activa
$nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario";
$correo_usuario = isset($_SESSION['correo']) ? $_SESSION['correo'] : "usuario@gmail.com";
$sesion_activa = isset($_SESSION['usuario']);

// Incluir el archivo de conexión a la base de datos
include '../conexion/database.php';

// Establecer la conexión con la base de datos
$conn = conectarse();

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Recuperar el ID del pedido de la URL
$pedido_id = $_GET['pedido_id'];

// Preparar la consulta para obtener los detalles del pedido
$sql = "SELECT pedidos.id_pedido, pedidos.fecha_pedido, pedidos.estado, pedidos.direccion, 
                detalle_pedido.cantidad, detalle_pedido.precio, productos.nombre AS nombre_producto
        FROM pedidos
        JOIN detalle_pedido ON pedidos.id_pedido = detalle_pedido.id_pedido
        JOIN productos ON detalle_pedido.id_producto = productos.id_producto
        WHERE pedidos.id_pedido = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pedido</title>
    <style>
        .user-info {
            margin-bottom: 20px;
        }
        .order-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Información del usuario -->
    <div class="user-info">
        <h2>Información del Usuario</h2>
        <p>Nombre: <?php echo htmlspecialchars($nombre_usuario); ?></p>
        <p>Correo: <?php echo htmlspecialchars($correo_usuario); ?></p>
    </div>

    <!-- Detalles del pedido -->
    <div class="order-info">
        <h2>Detalles del Pedido</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>ID del Pedido: " . htmlspecialchars($row['id_pedido']) . "</p>";
                echo "<p>Fecha del Pedido: " . htmlspecialchars($row['fecha_pedido']) . "</p>";
                echo "<p>Estado: " . htmlspecialchars($row['estado']) . "</p>";
                echo "<p>Dirección: " . htmlspecialchars($row['direccion']) . "</p>";
                echo "<p>Producto: " . htmlspecialchars($row['nombre_producto']) . "</p>";
                echo "<p>Cantidad: " . htmlspecialchars($row['cantidad']) . "</p>";
                echo "<p>Precio: " . htmlspecialchars($row['precio']) . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>No se encontraron detalles para este pedido.</p>";
        }

        // Cerrar el statement y la conexión
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
