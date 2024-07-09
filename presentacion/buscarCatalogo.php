<!DOCTYPE html>
<html lang="en">
   
   <head>
      
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>virtulentes</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <script src="//code.tidio.co/l5p8gpknmxff6tmbepqt2scdti8y7gw4.js" async></script>
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
     
   </head>
   <!-- body -->
   <body class="main-layout position_head">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <?php include 'navbar.php'?>
      <!-- end header inner -->
      <!-- end header -->
      <!-- Our  Glasses section -->
      <div class="glasses">
         
         <?php
require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php'; // Ajusta la ruta según tu estructura de archivos

// Establece la conexión a la base de datos
$link = conectarse();

// Verifica la conexión
if (!$link) {
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

// Asegúrate de tener el valor de $searchTerm definido antes de usarlo en la consulta SQL
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$searchTerm = mysqli_real_escape_string($link, $searchTerm);

$query = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.modelo_url, c.nombre_categoria
          FROM productos p
          LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
          WHERE p.nombre LIKE '%$searchTerm%'";

$result = mysqli_query($link, $query);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <button class="btn btn-secondary" onclick="window.location.href = 'glasses.php';" style="display: block; margin: 0 auto;">Volver al Catalogo</button>
        <br>
    <title>Resultados de búsqueda</title>
    <!-- Tus estilos y otros elementos head aquí -->
    <style>
    .product-container {
        text-align: center;
        margin: 10px;
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
</head>
<body>

<div class="container">
    <h2>Resultados de búsqueda</h2>

    <div class="row">
        <?php while ($producto = mysqli_fetch_assoc($result)): ?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">                  
                <div class="product-container">
                    <a href="detalleProductos.php?id=<?php echo $producto['id_producto']; ?>">
                        <figure>
                            <img class="product-image" src="<?php echo htmlspecialchars($producto['modelo_url']); ?>" alt="Modelo del Producto">
                        </figure>
                        <div class="product-name"><?php echo htmlspecialchars($producto['nombre']); ?></div>
                        <div class="product-description"><?php echo htmlspecialchars($producto['descripcion']); ?></div>
                        <div class="price-container">
                            <?php
                            // Ejemplo de cálculo de precios con un factor de descuento
                            $factor = 0.5; // 50% de descuento
                            $precioConDescuento = $producto['precio'] * (1 - $factor);
                            ?>
                            <span class="original-price"><?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?></span>
                            <span class="discount-price"><?php echo htmlspecialchars(number_format($precioConDescuento, 2)); ?></span>
                            <span class="discount-label"><?php echo htmlspecialchars(($factor * 100) . '% Dcto'); ?></span>
                        </div>
                        <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>

<?php
// Cierra la conexión después de usarla
mysqli_close($link);
?>
    
      <!-- end Our  Glasses section -->
      <!--  footer -->
      <?php
      include("footer.html");
      ?>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- FUNCION CARRITO DE COMPRAS -->
      <script src="carrito.js"></script>
   </body>
</html>
