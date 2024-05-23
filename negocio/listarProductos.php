<?php while ($producto = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
            <td><?php echo htmlspecialchars($producto['stock']); ?></td>
            <td><?php echo htmlspecialchars($producto['modelo_url']); ?></td>
            <td><?php echo htmlspecialchars($producto['id_categoria']); ?></td>
            <td class="actions">
                <a href="/VirtuLentes/negocio/editarProductos.php?id=<?php echo $producto['id_producto']; ?>">Editar</a> |
                <a href="/VirtuLentes/negocio/eliminarProductos.php?id=<?php echo $producto['id_producto']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>