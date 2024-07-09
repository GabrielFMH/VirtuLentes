<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Registro de Usuario</title>
  <!-- script src="https://www.google.com/recaptcha/api.js" async defer></script -->
  
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>virtulentes</title>
      <title></title>
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
<body>

<div id="video-container">
  <video autoplay loop muted id="video-background">
    <source src="video.mp4" type="video/mp4">
  </video>
  <?php include('navbar.php'); ?>
  <br><br><br><br><br><br>
  <link rel="stylesheet" href="css/style_login.css">
  <div class="content">
    <form class="contenedor" method="post" action="../negocio/validarregistro.php">
      <div class="container">
        <section class="form-login">
          <h2>Registro de Usuario</h2>
          <label for="nombre">Nombre:</label>
          <div class="form-group">
            <input class="controls" type="text" id="nombre" name="nombre" placeholder="Nombre" required>
          </div>
          <label for="email">Email:</label>
          <div class="form-group">
            <input class="controls" type="email" id="email" name="email" placeholder="Correo electrónico" required>
          </div>
          <label for="contrasena">Contraseña:</label>
          <div class="form-group">
            <input class="controls" type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          </div>
          <label for="dni">DNI:</label>
          <div class="form-group">
            <input class="controls" type="text" id="dni" name="dni" placeholder="Número de DNI">
          </div>
          <!-- Nuevo campo para dirección -->
          <label for="direccion">Dirección:</label>
          <div class="form-group">
            <input class="controls" type="text" id="direccion" name="direccion" placeholder="Dirección">
          </div>
          <div class="form-group">
            <input class="buttons" type="submit" value="Registrarse">
          </div>
          <div class="form-group">
            <a class="buttons" href="loginusuario.php">Cancelar</a>
          </div>
        </section>
      </div>
    </form>
  </div>


</body>
</html>
