<?php

$query = "SELECT 
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
GROUP BY 
    p.id_pedido, u.nombre, p.fecha_pedido, p.estado
ORDER BY 
    p.fecha_pedido DESC, 
    p.fecha_entrega DESC ;
";

$result = mysqli_query($link, $query)

?>

<?php while ($pedido = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo htmlspecialchars($pedido['ID Pedido']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Nombre de Usuario']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Fecha de Pedido']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Cantidad']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Estado']); ?></td>
        <td><?php echo htmlspecialchars($pedido['Fecha de Entrega']); ?></td>
        <td><?php echo htmlspecialchars($pedido['direccion']); ?></td>
        <td class="actions">
            <a href="/VirtuLentes/presentacion/admin/crudDetallePedido.php?id=<?php echo urlencode($pedido['ID Pedido']); ?>">
            <button class="submit">Ver detalle</button>
            </a>&nbsp;
            <style>
.submit {

    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: blue;
    border: none;
    border-radius: 5px;
    text-align: center;


}
.submit2 {

    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: red;
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
}

</style>
            <form action="/VirtuLentes/presentacion/admin/crudAgregarEnvio.php" method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['ID Pedido']); ?>">
            <button class="submit2">Agregar Fecha Envio</button>
        </form>
        </td>
    </tr>
<?php endwhile; ?>