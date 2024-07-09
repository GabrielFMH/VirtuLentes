<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion/database.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $subtotal = $_POST["subtotal"]; // Subtotal del pedido
    $cart = json_decode($_POST["cart"], true); // Recuperar el carrito de la solicitud POST
    $username = isset($_POST["username"]) ? $_POST["username"] : null; // Nombre de usuario enviado desde carrito2.js

    // Establecer la conexión con la base de datos
    $conn = conectarse();

    // Verificar si hay errores en la conexión
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'error' => 'La conexión falló: ' . $conn->connect_error]));
    }

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Variables para almacenar datos de usuario
        $id_usuario = null;
        $direccion = "Tacna"; // Dirección por defecto

        // Si hay un nombre de usuario disponible, obtener su ID y dirección
        if ($username) {
            // Obtener el ID del usuario y su dirección basado en el nombre de usuario recibido
            $sql_usuario = "SELECT id_usuario, direccion FROM usuarios WHERE nombre = ?";
            $stmt_usuario = $conn->prepare($sql_usuario);
            $stmt_usuario->bind_param("s", $username);
            $stmt_usuario->execute();
            $result_usuario = $stmt_usuario->get_result();

            if ($result_usuario->num_rows > 0) {
                $row_usuario = $result_usuario->fetch_assoc();
                $id_usuario = $row_usuario["id_usuario"];
                $direccion = $row_usuario["direccion"];
            } else {
                throw new Exception("No se encontró el usuario en la base de datos: " . $username);
            }
        }

        // Establecer la zona horaria a Lima, Perú
        date_default_timezone_set('America/Lima');
        
        // Insertar el pedido en la tabla 'pedidos'
        $fecha_pedido = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual
        $estado = "Pendiente"; // Estado por defecto

        $sql_pedido = "INSERT INTO pedidos (id_usuario, fecha_pedido, estado, direccion) VALUES (?, ?, ?, ?)";
        $stmt_pedido = $conn->prepare($sql_pedido);
        $stmt_pedido->bind_param("isss", $id_usuario, $fecha_pedido, $estado, $direccion);

        if ($stmt_pedido->execute()) {
            $pedido_id = $stmt_pedido->insert_id;

            foreach ($cart as $item) {
                $nombre_producto = $item["nombre_producto"];
                $cantidad = $item["cantidad"];
                $precio = $item["precio"];

                $sql_id_producto = "SELECT id_producto FROM productos WHERE nombre = ?";
                $stmt_id_producto = $conn->prepare($sql_id_producto);
                $stmt_id_producto->bind_param("s", $nombre_producto);
                $stmt_id_producto->execute();
                $result_id_producto = $stmt_id_producto->get_result();

                if ($result_id_producto->num_rows > 0) {
                    $row = $result_id_producto->fetch_assoc();
                    $id_producto = $row["id_producto"];

                    $sql_detalle_pedido = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
                    $stmt_detalle_pedido = $conn->prepare($sql_detalle_pedido);
                    $stmt_detalle_pedido->bind_param("iiid", $pedido_id, $id_producto, $cantidad, $precio);

                    if (!$stmt_detalle_pedido->execute()) {
                        throw new Exception("Error al agregar detalles del pedido: " . $conn->error);
                    }
                    $stmt_detalle_pedido->close();
                } else {
                    throw new Exception("No se pudo encontrar el producto en la base de datos: " . $nombre_producto);
                }
                $stmt_id_producto->close();
            }

            $conn->commit();
            // Devolver el ID del pedido y el éxito como JSON
            echo json_encode(['success' => true, 'pedido_id' => $pedido_id]);
        } else {
            throw new Exception("Error al crear el pedido: " . $stmt_pedido->error);
        }
        // Cerrar los statements
        $stmt_pedido->close();
        if (isset($stmt_usuario)) {
            $stmt_usuario->close();
        }

        // Cerrar la conexión con la base de datos
        $conn->close();
    } catch (Exception $e) {
        // Rollback la transacción en caso de error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => 'Error en el procesamiento del pedido: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Error: No se ha enviado ningún formulario.']);
}
?>
