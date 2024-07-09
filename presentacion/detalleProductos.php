<?php
require '../conexion/database.php'; // Asegúrate de que el path aquí sea correcto para incluir database.php

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Obtiene el ID y asegura que sea un entero

$link = conectarse(); // Usa la función de conexión que definiste

// Prepara la consulta SQL
$query = "SELECT p.*, c.nombre_categoria, dp.foto_url 
          FROM productos p
          LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
          LEFT JOIN detalle_producto dp ON p.id_producto = dp.id_producto
          WHERE p.id_producto = ?";

$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$producto = mysqli_fetch_assoc($result);

if (!$producto) {
    echo "<p>Producto no encontrado.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .product-detail-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            display: flex;
            flex-wrap: wrap;
        }
        .product-image {
            flex: 1;
            text-align: center;
            margin: 20px;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
        }
        .product-details {
            flex: 2;
            margin: 20px;
        }
        .product-details h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .product-details .price-container {
            display: flex;
            align-items: baseline;
            margin: 10px 0;
        }
        .product-details .original-price {
            text-decoration: line-through;
            color: gray;
            font-size: 1.2em;
            margin-right: 10px;
        }
        .product-details .discount-price {
            color: red;
            font-size: 1.8em;
            font-weight: bold;
        }
        .product-container .discount-label {
        color: gray;
        font-size: 1em;
        }
        .product-details .product-description {
            margin: 20px 0;
            font-size: 1.2em;
            color: #333;
        }
        .product-details .btn {
            margin-top: 20px;
        }
    </style>
    <script src="//code.tidio.co/qatp5jdro988liyufwrlqw6fuciktkkp.js" async></script>
</head>
<body class="main-layout position_head">
    <!-- Loader -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- Header -->
    <?php include 'navbar.php'?>
    <!-- Product Details -->
    <div class="container">
        <div class="product-detail-container">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($producto['modelo_url']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
            </div>
            <div class="product-details">
                <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                <div class="price-container">
                <?php
                    $factor = 2;
                    $precioConFactor = $producto['precio'] * $factor;
                    ?>
                    <span class="original-price"><?php echo htmlspecialchars($precioConFactor); ?></span>
                    <span class="discount-price"><?php echo htmlspecialchars($producto['precio']); ?></span>
                    <span class="discount-label">50% Dcto</span>
                </div>
                <p class="product-description"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <p>Categoría: <?php echo htmlspecialchars($producto['nombre_categoria']); ?></p>
                <p>Stock disponible: <?php echo htmlspecialchars($producto['stock']); ?></p>
                <p>Material: <?php echo htmlspecialchars($producto['material']); ?></p>
                <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                <a class="btn btn-secondary" href="3dprueba.php?id=<?php echo $producto['id_producto']; ?>">Ver modelo 3D</a>
                <a class="btn btn-secondary" href="/VirtuLentes/presentacion/reconocimiento/dist/dat.php?id=<?php echo $producto['id_producto']; ?>">Probrador</a>
            </div>
        </div>
        <!-- Lista de otros productos -->
        <div class="row">
            <?php
            // Define un factor de "descuento" para mostrar el precio inflado
            $factor = 2;
            // Consulta para obtener todos los productos
            $query_all = "SELECT * FROM productos";
            $result_all = mysqli_query($link, $query_all);

            while ($row = mysqli_fetch_assoc($result_all)): ?>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="product-container">
                        <a href="detalleProductos.php?id=<?php echo $row['id_producto']; ?>">
                            <img class="product-image" src="<?php echo htmlspecialchars($row['modelo_url']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <div class="product-name"><?php echo htmlspecialchars($row['nombre']); ?></div>
                            <div class="product-description"><?php echo htmlspecialchars($row['descripcion']); ?></div>
                            <div class="price-container">
                                <span class="original-price"><?php echo htmlspecialchars($row['precio'] * $factor); ?></span>
                                <span class="discount-price"><?php echo htmlspecialchars($row['precio']); ?></span>
                                <span class="discount-label">50% Dcto</span>
                            </div>
                        </a>
                        <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- Footer -->
    <?php
    include("footer.html");
    ?>
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- Carrito Script -->
    <script src="carrito.js"></script>
</body>
</html>
