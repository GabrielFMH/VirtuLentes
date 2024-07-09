<style>
    .product-container {
        text-align: center;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .product-container img {
        width: 100%;
        height: auto;
    }
    .product-container .price-container {
        display: flex;
        justify-content: center;
        align-items: baseline;
        margin: 10px 0;
    }
    .product-container .original-price {
        text-decoration: line-through;
        color: gray;
        font-size: 1.1em;
        margin-right: 10px;
    }
    .product-container .discount-price {
        color: red;
        font-size: 1.5em;
        font-weight: bold;
        margin-right: 5px;
    }
    .product-container .discount-label {
        color: gray;
        font-size: 1em;
    }
    .product-container .product-name {
        font-size: 1.2em;
        font-weight: bold;
    }
    .product-container .product-description {
        color: gray;
        font-size: 1em;
        margin-bottom: 10px
    }
</style>

<?php
$factor = 2;
$query = "
    SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.modelo_url, c.nombre_categoria
    FROM productos p
    LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
";
$result = mysqli_query($link, $query);
?>

<?php while ($producto = mysqli_fetch_assoc($result)): ?>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">                  
        <div class="product-container">
            <a href="detalleProductos.php?id=<?php echo $producto['id_producto']; ?>">
                <figure>
                    <td><img class="product-image" src="<?php echo htmlspecialchars($producto['modelo_url']); ?>" alt="Modelo del Producto"></td>
                </figure>
                <div class="product-name"><?php echo htmlspecialchars($producto['nombre']); ?></div>
                <div class="product-description"><?php echo htmlspecialchars($producto['descripcion']); ?></div>
                <div class="price-container">
                <?php
                    $precioConFactor = $producto['precio'] * $factor;
                    ?>
                    <span class="original-price"><?php echo htmlspecialchars($precioConFactor); ?></span>
                    <span class="discount-price"><?php echo htmlspecialchars($producto['precio']); ?></span>
                    <span class="discount-label">50% Dcto</span>
                    <!-- Aquí puedes agregar el precio con descuento si es necesario -->
                </div>
                <a class="btn btn-primary" href="#">Añadir al Carrito</a>
            </a>
        </div>
    </div>
<?php endwhile; ?>
