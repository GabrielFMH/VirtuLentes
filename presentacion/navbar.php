<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
$nombre_usuario = "Usuario";
$correo_usuario = "usuario@gmail.com";
$sesion_activa = false;

if (isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
    $correo_usuario = $_SESSION['correo'];
    $sesion_activa = true;
}
?>
 

<!-- header -->
<header>
    <!-- header inner -->
    <div class="header">
       <div class="container-fluid">
          <div class="row">
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                <div class="full">
                   <div class="center-desk">
                      <div class="logo">
                         <a href="index.php"><img src="images/virtuLogo.png" width="150px" height="0px" alt="#" /></a>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <nav class="navigation navbar navbar-expand-md navbar-dark ">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse" id="navbarsExample04">
                      <ul class="navbar-nav mr-auto">
                         <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="about.php">Nosotros</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="glasses.php">Catalogo</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contacto</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="medidas.php">Medidas</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="reconocimiento/dist/index.php">Tipo de rostro</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" href="pedidos.php">Pedidos</a>
                         </li>
                         <li class="nav-item d_none login_btn">
                            <a class="nav-link" href="login.php">Admin</a>
                         </li>
                         <?php if (!$sesion_activa) { ?>
                         <li class="nav-item d_none">
                            <a class="nav-link" href="loginusuario.php">User</a>
                         </li>
                         <?php } ?>
                         
                         <li>
                            <img onclick="showCart()" class="cart" src="https://i.imgur.com/z1SeOiw.png" alt="Cart" style="width: 30px; height: 30px;">
                            <div id="cart-container" class="cart-container" style="display: none; width: 200px;">
                               <div id="cart-items" style="display: flex; flex-wrap: wrap;">
                                   <!-- Aquí se añadirán los productos dinámicamente -->
                               </div>
                               <div>
                                   <button onclick="goToCart()">Ir al Carrito</button>
                                   <button onclick="clearCart()">Vaciar Carrito</button>
                               </div>
                            </div>
                         </li>
                         <?php if ($sesion_activa) { ?>
                         <li class="nav-item user-panel">
                            <a href="perfilUsuario.php" class="user-name"><?php echo $nombre_usuario; ?></a>
                            <div class="dropdown">
                               <div><?php echo $correo_usuario; ?></div>
                               <div>
                                  <a href="/VirtuLentes/negocio/salir_usuario.php">
                                     <ion-icon name="exit-outline"></ion-icon>
                                     <span>Salir</span>
                                  </a>
                               </div>
                            </div>
                         </li>
                         <?php } ?>
                      </ul>
                   </div>
                </nav>
             </div>
          </div>
       </div>
    </div>
 </header>
 <!-- end header inner -->


 <style>
   .user-panel {
       position: relative;
       display: inline-block;
       margin-left: 20px;
   }
   .user-panel:hover .dropdown {
       display: block;
   }
   .user-name {
       cursor: pointer;
   }
   .dropdown {
       display: none;
       position: absolute;
       right: 0;
       background-color: white;
       box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
       z-index: 1;
   }
   .dropdown div {
       padding: 10px;
       border-bottom: 1px solid #ccc;
   }
   .dropdown div:last-child {
       border-bottom: none;
   }
   .dropdown div a {
       text-decoration: none;
       color: black;
       display: block;
   }
   .dropdown div a:hover {
       background-color: #f1f1f1;
   }
</style>

<link rel="stylesheet" href="css/stylecarrito.css">

<script src="carrito.js"></script>