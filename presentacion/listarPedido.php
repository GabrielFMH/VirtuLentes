<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Nombre de usuario obtenido de la sesión
$nombre_usuario = $_SESSION['usuario'];
$query = "
    SELECT 
        p.id_pedido AS 'ID Pedido',
        u.nombre AS 'Nombre de Usuario',
        p.fecha_pedido AS 'Fecha de Pedido',
        SUM(dp.cantidad) AS 'Cantidad',
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
        u.nombre = '$nombre_usuario'  -- Ajusta esta condición según tu necesidad
    GROUP BY 
        p.id_pedido, u.nombre, p.fecha_pedido, p.estado
    ORDER BY 
        p.fecha_pedido DESC, 
        p.fecha_entrega DESC ;
";
$result = mysqli_query($link, $query);
?>

<table class="table-pedidos">
    <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Nombre de Usuario</th>
            <th>Fecha de Pedido</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Fecha de Entrega</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($pedido = mysqli_fetch_assoc($result)): ?>
    <tr>
    <td><?php echo isset($pedido['Nombre de Usuario']) ? htmlspecialchars($pedido['ID Pedido']) : ''; ?></td>
        <td><?php echo isset($pedido['Nombre de Usuario']) ? htmlspecialchars($pedido['Nombre de Usuario']) : ''; ?></td>
        <td><?php echo isset($pedido['Fecha de Pedido']) ? htmlspecialchars($pedido['Fecha de Pedido']) : ''; ?></td>
        <td><?php echo isset($pedido['Cantidad']) ? htmlspecialchars($pedido['Cantidad']) : ''; ?></td>
        <td><?php echo isset($pedido['Estado']) ? htmlspecialchars($pedido['Estado']) : ''; ?></td>
        <td><?php echo isset($pedido['Fecha de Entrega']) ? htmlspecialchars($pedido['Fecha de Entrega']) : ''; ?></td>
        <td><?php echo isset($pedido['direccion']) ? htmlspecialchars($pedido['direccion']) : ''; ?></td>
        <td class="actions">
        <a href="detallePedido.php?id=<?php echo urlencode($pedido['ID Pedido']); ?>">
                        <button class="btn-ver-detalle">Ver detalle</button>
                    </a>
                    <form action="/VirtuLentes/presentacion/admin/crudAgregarEnvio.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['ID Pedido']); ?>">
                        
                    </form>
        </td>
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
