<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Formulario Login</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div id="video-container">
  <video autoplay loop muted id="video-background">
    <source src="video.mp4" type="video/mp4">
  </video>
  <?php include('header.php'); ?>
  <br><br><br><br><br><br>
  <link rel="stylesheet" href="css/style_login.css">

  <div class="content">
  <form class="contenedor" method="post" action="../negocio/Logica_login.php" onsubmit="return validarRecaptcha()">
    <div class="container">
      <section class="form-login">
        <h2>Login Admin</h2>
        <label class="etique">Usuario:</label>
        <div class="form-group">
          <input class="controls <?php echo isset($error_class_usuario) ? $error_class_usuario : ''; ?>" type="text" name="usuario" value="" placeholder="Usuario">
        </div>
        <label class="etique2">Contraseña:</label>
        <div class="form-group">
          <input class="controls <?php echo isset($error_class_contrasena) ? $error_class_contrasena : ''; ?>" type="password" name="contrasena" value="" placeholder="Contraseña">
        </div>
          <label class="etique2">Recaptcha:</label>
          <div class="mb-3" required>
            <div class="g-recaptcha" data-sitekey="6Ld_t_koAAAAAMSDKyzZEQxAwpevsUkr7lNadtp_" id="recaptcha"></div>
          </div> 
        <div class="form-group">
          <input class="buttons" type="submit" name="" value="Ingresar">
        </div>
      </section>
    </div>
  </form>
</div>

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

</body>
</html>
