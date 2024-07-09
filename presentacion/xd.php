<?php
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
        $stmt_pedido->close();
        $stmt_usuario->close();



?>