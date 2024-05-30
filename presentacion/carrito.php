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
                          <tbody>
                            <tr>
                              <td class="product-thumbnail">
                                <img src="images/cloth_1.jpg" alt="Image" class="img-fluid">
                              </td>
                              <td class="product-name">
                                <h2 class="h5 text-black">Top Up T-Shirt</h2>
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
          
                            <tr>
                              <td class="product-thumbnail">
                                <img src="images/cloth_2.jpg" alt="Image" class="img-fluid">
                              </td>
                              <td class="product-name">
                                <h2 class="h5 text-black">Polo Shirt</h2>
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
                          <button class="btn btn-primary btn-sm btn-block">Actualizar Carro</button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-outline-primary btn-sm btn-block">Volver a la Tienda</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="text-black h4" for="coupon">Coupon</label>
                          <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                          <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                          <button class="btn btn-primary btn-sm">Apply Coupon</button>
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
                              <strong class="text-black">$230.00</strong>
                            </div>
                          </div>
                          <div class="row mb-5">
                            <div class="col-md-6">
                              <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                              <strong class="text-black">$230.00</strong>
                            </div>
                          </div>
          
                          <div class="row">
                            <div class="col-md-12">
                              <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Realizar Pedido</button>
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
      <script>
        function updateQuantity(button, increment) {
           const input = button.parentElement.parentElement.querySelector('.quantity-input');
           let value = parseInt(input.value);
           value += increment;
           if (value < 1) value = 1;  // Ensure the quantity cannot be less than 1
           input.value = value;
        }
     </script>
   </body>
</html>