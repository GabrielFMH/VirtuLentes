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
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
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
      <script src="//code.tidio.co/qatp5jdro988liyufwrlqw6fuciktkkp.js" async></script>
      <!-- Initialize the JS-SDK -->
      <script
      src="https://www.paypal.com/sdk/js?client-id=AZ3B12q0IRcwolGuKPqjmdWSAvgSZ7BP9HzyDlg1NwHWbnEVodwSnxSrKgsLsBTIBZoWZ5co8zCCXOAk&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo" data-sdk-integration-source="developer-studio">
    </script>

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
      <!-- Our shop section -->
      <div id="about" class="shop">
         


        <div class="site-wrap">
          
              <div class="site-section">
                <div class="container">
                  <div class="row mb-5">
                    <form class="col-md-12" method="post">
                      <div class="site-blocks-table">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="product-thumbnail">Imagen</th>
                              <th class="product-name">Producto</th>
                              <th class="product-price">Precio</th>
                              <th class="product-quantity">Cantidad</th>
                              <th class="product-total">SubTotal</th>
                              <th class="product-remove">Eliminar</th>
                            </tr>
                          </thead>
                          <tbody id="cart-table-body">
                            <tr>
                              <td class="product-thumbnail">
                                <img src="images/cloth_1.jpg" alt="Image" class="img-fluid">
                              </td>
                              <td class="product-name">
                                <h2 class="h5 text-black">Lente 1</h2>
                              </td>
                              <td>$49.00</td>
                              <td>
                                <div class="input-group mb-3" style="max-width: 120px;">
                                  <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button" onclick="updateQuantity(this, -1)">&minus;</button>
                                  </div>
                                  <input type="text" class="form-control text-center quantity-input" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button" onclick="updateQuantity(this, 1)">&plus;</button>
                                  </div>
                                </div>
          
                              </td>
                              <td>$49.00</td>
                              <td><a href="#" class="btn btn-primary btn-sm">X</a></td>
                            </tr>
          
                          </tbody>
                        </table>
                      </div>
                    </form>
                  </div>
          
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                          <button id="actualizar-carro-btn" class="btn btn-primary btn-sm btn-block">Actualizar Carro</button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location.href = 'glasses.php';">Volver a la Tienda</button>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-md-6 pl-5">
                      <div class="row justify-content-end">
                        <div class="col-md-7">
                          <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                              <h3 class="text-black h4 text-uppercase">Total de Compra</h3>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-6">
                              <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                              <strong class="text-black" id="subtotal">$0.00</strong>
                            </div>
                          </div>
                          <div class="row mb-5">
                            <div class="col-md-6">
                              <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                              <strong class="text-black" id="total">$0.00</strong>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                              <h3 class="text-black h4 text-uppercase">Seleccione forma de pago</h3>
                            </div>
                          </div>
          
                          <div class="row">
                            <div class="col-md-12">
                            <div id="paypal-button-container"></div>
                              <div id="success-message" class="alert alert-success" style="display: none;">
                                  Pedido realizado con éxito.
                              </div>
                              <form id="pedido-form" onsubmit="return procesarPedido(event)">
                                  <!-- Campo oculto para enviar el subtotal al servidor -->
                                  <input type="hidden" name="subtotal" id="subtotal-input">
                                  <!-- Campo oculto para enviar el carrito al servidor -->
                                  <input type="hidden" name="cart" id="cart-input">
                                  <!-- Botón para realizar el pedido -->
                                  <button id="realizar-pedido-btn" class="btn btn-primary btn-lg py-3 btn-block" type="submit">Realizar Pedido</button>
                                  
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
            </div>


        



      </div>
      <!-- end Our shop section -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                     <ul class="location_icon">
                        <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> Location</li>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a><br> +51 xxxxxxxxxxx</li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> example@gmail.com</li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2024 All Rights Reserved. Design by DAYUVI</p>
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

     <script src="carrito2.js"></script>

     <script src="paypal.js"></script>

<style>
   .product-thumbnail img {
      max-width: 100px; /* Ajusta el tamaño máximo de la imagen según lo necesites */
      height: auto; /* Mantiene la proporción de la imagen */
   }
   #realizar-pedido-btn {
        display: none; /* Oculta el botón pero sigue presente en el DOM */
    }
</style>
   </body>
</html>