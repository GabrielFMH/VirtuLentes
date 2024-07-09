<?php
include 'database.php';

$tipo = $_GET['tipo'] ?? null;

if ($tipo) {
    $link = conectarse();
    
    if (!$link) {
        die("Error: No se pudo conectar a la base de datos.");
    }

    $sql = 'SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.modelo_url 
            FROM productos p 
            JOIN model_tipo_rostro mt ON p.id_tipo = mt.id_tipo 
            WHERE mt.categoria = ?';
    $stmt = $link->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $link->error);
    }

    $stmt->bind_param('s', $tipo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $lentes = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $link->close();
} else {
    $lentes = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>virtulentes</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../../css/style.css">
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
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="main-layout position_head">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="../../images/loading.gif" alt="#" /></div>
    </div>

    <?php include '../../navbar.php'; ?>

    <div class="glasses">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="titlepage">
                        <h2>Modelos Recomendados para Tu Tipo de Rostro <?= htmlspecialchars($tipo) ?></h2>
                        <p>Explora nuestra selección exclusiva de lentes especialmente recomendados para realzar la elegancia y el estilo de tu tipo de rostro <?= htmlspecialchars($tipo) ?>. Cada modelo ha sido cuidadosamente elegido para ofrecerte la mejor combinación de comodidad y diseño.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?php if (!empty($lentes)): ?>
                    <?php foreach ($lentes as $lente): ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="product-container">
                                <a href="../../detalleProductos.php?id=<?= htmlspecialchars($lente['id_producto']) ?>">
                                    <figure>
                                        <?php if (!empty($lente['modelo_url'])): ?>
                                            <img class="product-image" src="<?= htmlspecialchars($lente['modelo_url']) ?>" alt="<?= htmlspecialchars($lente['nombre']) ?>">
                                        <?php endif; ?>
                                    </figure>
                                    <div class="product-name"><?= htmlspecialchars($lente['nombre']) ?></div>
                                    <div class="product-description"><?= htmlspecialchars($lente['descripcion']) ?></div>
                                    <div class="price-container">
                                        <span class="original-price"><?= htmlspecialchars($lente['precio'] * 2) ?></span>
                                        <span class="discount-price"><?= htmlspecialchars($lente['precio']) ?></span>
                                        <span class="discount-label">50% Dcto</span>
                                    </div>
                                    <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No se encontraron lentes para este tipo de rostro.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">                    
                <div class="col-md-12">
                    <a class="read_more" href="../../glasses.php">Ver más</a>
                </div>
            </div>
        </div>
    </div>


    <!-- end footer -->
    <!-- Javascript files-->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/custom.js"></script>
    <!-- FUNCION CARRITO DE COMPRAS -->
    <script src="../../carrito.js"></script>
    <script>
    function goToCart() {
    // Guarda el carrito en el almacenamiento local
    localStorage.setItem('cart', JSON.stringify(cart));
    // Redirige a carrito.php
    window.location.href = '../../carrito.php';
 }
 </script>
</body>
</html>
