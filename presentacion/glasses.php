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
      <title>sungla</title>
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
      <?php include 'navbar.html'?>
      <!-- end header inner -->
      <!-- end header -->
      <!-- Our  Glasses section -->
      <div class="glasses">
         <div class="container">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="titlepage">
                     <h2>Nuestros Lentes</h2>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor
                        e et dolore magna aliqua. Ut enim ad minim veniam, qui
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <div class="product-container">
                     <figure>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTxa6xBhtUISgT1UbQGtyshQcIkTBlywfUtA&s" alt="#"/>
                     </figure>
                     <p class="product-name">Prada Linea Rossa</p><br>
                     <p class="product-description">0PS 54IS Negro Hombre</p><br>
                     <div class="price-container">
                        <span class="original-price">S/ 1,125.00</span>
                        <span class="discount-price">S/ 562.50</span>
                        <span class="discount-label">50% Dcto</span>
                    </div>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="product-container">
                     <figure>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTxa6xBhtUISgT1UbQGtyshQcIkTBlywfUtA&s" alt="#"/>
                     </figure>
                     <p class="product-name">Prada Linea Rossa</p><br>
                     <p class="product-description">0PS 54IS Negro Hombre</p><br>
                     <div class="price-container">
                        <span class="original-price">S/ 1,125.00</span>
                        <span class="discount-price">S/ 562.50</span>
                        <span class="discount-label">50% Dcto</span>
                    </div>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="product-container">
                     <figure>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTxa6xBhtUISgT1UbQGtyshQcIkTBlywfUtA&s" alt="#"/>
                     </figure>
                     <p class="product-name">Prada Linea Rossa</p><br>
                     <p class="product-description">0PS 54IS Negro Hombre</p><br>
                     <div class="price-container">
                        <span class="original-price">S/ 1,125.00</span>
                        <span class="discount-price">S/ 562.50</span>
                        <span class="discount-label">50% Dcto</span>
                    </div>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="images/glass4.png" alt="#"/></figure>
                     <h3><span class="blu">$</span>50</h3>
                     <p>Sunglasses</p><br>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="images/glass5.png" alt="#"/></figure>
                     <h3><span class="blu">$</span>50</h3>
                     <p>Sunglasses</p><br>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="images/glass6.png" alt="#"/></figure>
                     <h3><span class="blu">$</span>50</h3>
                     <p>Sunglasses</p><br>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="images/glass7.png" alt="#"/></figure>
                     <h3><span class="blu">$</span>50</h3>
                     <p>Sunglasses</p><br>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="images/glass8.png" alt="#"/></figure>
                     <h3><span class="blu">$</span>50</h3>
                     <p>Sunglasses</p><br>
                     <a class="btn btn-primary" href="#">Añadir al Carrito</a>
                  </div>
               </div>
               <div class="col-md-12">
                  <a class="read_more" href="#">Read More</a>
               </div>
            </div>
         </div>
      </div>
      <!-- end Our  Glasses section -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                     <ul class="location_icon">
                        <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> Location</li>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><br> +01 1234567890</li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> demo@gmail.com</li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>

