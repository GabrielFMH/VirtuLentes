<?php

$query = "
    SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.modelo_url, c.nombre_categoria
    FROM productos p
    LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
";
$result = mysqli_query($link, $query);

?>

<table>
    <?php while ($producto = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
        <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
        <td><?php echo htmlspecialchars($producto['precio']); ?></td>
        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
        <td><img src="<?php echo htmlspecialchars($producto['modelo_url']); ?>" height="100px" width="100px" alt="Modelo del Producto"></td>
        <td><?php echo htmlspecialchars($producto['nombre_categoria']); ?></td>
        <td class="actions">
            <a href="/VirtuLentes/negocio/editarProductos.php?id=<?php echo $producto['id_producto']; ?>">Editar</a> |
            <a href="/VirtuLentes/negocio/eliminarProductos.php?id=<?php echo $producto['id_producto']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a> |
            <a href="/VirtuLentes/negocio/administrarModelo3D.php?id=<?php echo $producto['id_producto']; ?>">Modelo 3D</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


