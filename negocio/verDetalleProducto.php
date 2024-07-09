<?php

$query = "SELECT
    p.id_pedido AS 'ID Pedido',
    u.nombre AS 'Nombre de Usuario',
    p.fecha_pedido AS 'Fecha de Pedido',
    pr.nombre AS 'Nombre de Producto',
    dp.cantidad AS 'Cantidad',
    dp.precio AS 'Precio Unitario',
    dp.cantidad * dp.precio AS 'Precio Total Producto',  
    SUM(dp.cantidad * dp.precio) OVER (PARTITION BY p.id_pedido) AS 'Precio Total Pedido',
    p.estado AS 'Estado'
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
";
    
$result = mysqli_query($link, $query)

?>

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