<?php

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
if(isset($_POST['fecha_busqueda'])){
    // Obtener el término de búsqueda
    $fechaBusqueda = mysqli_real_escape_string($link, $_POST['fecha_busqueda']);

    // Consulta SQL para buscar pedidos por ID de pedido
    $query = "SELECT 
        p.id_pedido AS 'ID Pedido',
        u.nombre AS 'Nombre de Usuario',
        p.fecha_pedido AS 'Fecha de Pedido',
        SUM(dp.cantidad) AS 'Cantidad',
        p.estado AS 'Estado',
        p.fecha_entrega AS 'Fecha de Entrega',
        p.direccion AS 'Direccion'
    FROM 
        Pedidos p
    JOIN 
        Detalle_Pedido dp ON p.id_pedido = dp.id_pedido
    JOIN 
        Productos pr ON dp.id_producto = pr.id_producto
    JOIN 
        Usuarios u ON p.id_usuario = u.id_usuario
    WHERE 
        DATE(p.fecha_pedido) = '$fechaBusqueda'
    GROUP BY 
        p.id_pedido, u.nombre, p.fecha_pedido, p.estado
    ORDER BY 
        p.fecha_pedido DESC, 
        p.fecha_entrega DESC;
    ";

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
    <title>Lista de Pedidos</title>

</head>
<body>
           
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["ID Pedido"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Nombre de Usuario"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Fecha de Pedido"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Cantidad"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Estado"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Fecha de Entrega"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Direccion"]) . '</td>';
                echo '<td class="actions">
                <a href="/VirtuLentes/presentacion/admin/crudDetallePedido.php?id=' . htmlspecialchars($row['ID Pedido']) . '">Ver detalle</a>
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