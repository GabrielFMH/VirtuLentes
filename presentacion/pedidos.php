<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verificar si hay un usuario logeado
if (isset($_SESSION['usuario'])) {
    // Si el usuario está logeado, muestra el enlace a pedidos.php
    echo '<li class="nav-item">
              <a class="nav-link" href="pedidos.php"></a>
          </li>';
} else {
    // Si no hay usuario logeado, redirige a la página de loginusuario.php
    header("Location: loginusuario.php");
    exit(); // Asegura que se detenga la ejecución después de la redirección
}
?>
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
      <script src="//code.tidio.co/qatp5jdro988liyufwrlqw6fuciktkkp.js" async></script>
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
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  
               </div>
            </div>
         </div>
         <?php
$searchTerm = ''; // Inicializa la variable $searchTerm

// Procesamiento de formulario de búsqueda si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y escapa el término de búsqueda
    $searchTerm = isset($_POST['search']) ? mysqli_real_escape_string($link, $_POST['search']) : '';

    // Aquí puedes realizar la lógica de búsqueda y mostrar resultados
}
?>
                         
         <div class="container-fluid">
            <div class="row">
            <?php
            require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';
            $searchTerm ='';
            $link = conectarse();
            $query = "SELECT * FROM productos";
            $result = mysqli_query($link, $query);
            if (!$result) {
               die('Error en la consulta: ' . mysqli_error($link));
            }
            ?>
            <?php include 'listarPedido.php'; ?>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">                    
               
            </div>
         </div>
      </div>
            
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