<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Formulario Login</title>
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
  <form class="contenedor" method="post" action="../negocio/validarusuario.php">
    <div class="container">
      <section class="form-login">
        <h2>Login Usuario</h2>
        <label class="etique">Usuario:</label>
        <div class="form-group">
          <input class="controls <?php echo isset($error_class_usuario) ? $error_class_usuario : ''; ?>" type="text" name="usuario" value="" placeholder="Usuario">
        </div>
        <label class="etique2">Contraseña:</label>
        <div class="form-group">
          <input class="controls <?php echo isset($error_class_contrasena) ? $error_class_contrasena : ''; ?>" type="password" name="contrasena" value="" placeholder="Contraseña">
        </div>
        <!--
        <label class="etique2">Recaptcha:</label>
        <div class="mb-3" required>
          <div class="g-recaptcha" data-sitekey="6LefDvUpAAAAADGXsH2m8It0UjwkKUcTTsJ1Jg_t" id="recaptcha"></div>
        </div>
        -->
        <div class="form-group">
          <input class="buttons" type="submit" name="" value="Ingresar">
        </div>
        <div class="form-group">
          <a class="buttons" href="registrarusuario.php">Registrarse</a>
        </div>
      </section>
    </div>
  </form>
</div>

<!--
<script>
  function validarRecaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
      alert('Por favor, complete el Recaptcha');
      return false;
    } else {
      document.getElementById('recaptchaResponse').value = response;
      return true;
    }
  }
</script>
-->

</body>
</html>
