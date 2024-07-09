<?php

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de login si no está autenticado
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario de la sesión
$nombre_usuario = $_SESSION['usuario'];

// Verificar si se proporcionó un ID de pedido válido
if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

    // Construir la consulta SQL para obtener el detalle del pedido específico
    $query = "
        SELECT 
            p.id_pedido AS 'ID Pedido',
            u.nombre AS 'Nombre de Usuario',
            p.fecha_pedido AS 'Fecha de Pedido',
            pr.nombre AS 'Nombre de Producto',
            dp.cantidad AS 'Cantidad',
            dp.precio AS 'Precio Unitario',
            dp.cantidad * dp.precio AS 'Precio Total Producto',
            SUM(dp.cantidad * dp.precio) OVER (PARTITION BY p.id_pedido) AS 'Precio Total Pedido',
            p.estado AS 'Estado',
            p.fecha_entrega AS 'Fecha de Entrega',
            p.direccion AS 'direccion'
        FROM 
            Pedidos p
        JOIN 
            Detalle_Pedido dp ON p.id_pedido = dp.id_pedido
        JOIN 
            Productos pr ON dp.id_producto = pr.id_producto
        JOIN 
            Usuarios u ON p.id_usuario = u.id_usuario
        WHERE 
            p.id_pedido = '$id_pedido'
            AND u.nombre = '$nombre_usuario'
        GROUP BY 
            p.id_pedido, u.nombre, p.fecha_pedido, pr.nombre, dp.cantidad, dp.precio, p.estado, p.fecha_entrega, p.direccion
        ORDER BY 
            p.fecha_pedido DESC, 
            p.fecha_entrega DESC;
    ";

    // Realizar la consulta SQL
    $result = mysqli_query($link, $query);

    // Verificar si hay errores en la consulta
    if (!$result) {
        echo "Error en la consulta: " . mysqli_error($link);
        exit();
    }
} else {
    // Manejo si no se proporciona un ID de pedido válido
    echo "ID de pedido no válido";
}


?>
<table class="table-pedidos">
    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Nombre de Usuario</th>
            <th>Fecha de Pedido</th>
            <th>Nombre de Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Total Producto</th>
            <th>Precio Total Pedido</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($pedido = mysqli_fetch_assoc($result)): ?>
    <tr>
    <td><?php echo htmlspecialchars($pedido['ID Pedido']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Nombre de Usuario']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Fecha de Pedido']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Nombre de Producto']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Cantidad']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Precio Unitario']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Precio Total Producto']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Precio Total Pedido']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Estado']); ?></td>
    </tr>
<?php endwhile; ?>
    </tbody>
</table>

<style>
    .table-pedidos {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table-pedidos th, .table-pedidos td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    .table-pedidos th {
        background-color: #f2f2f2;
    }

    .btn-ver-detalle, .btn-agregar-envio {
        padding: 8px 16px;
        font-size: 14px;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-agregar-envio {
        background-color: #dc3545;
        margin-left: 5px;
    }

    .btn-ver-detalle:hover, .btn-agregar-envio:hover {
        background-color: #0056b3;
    }
</style>