<!DOCTYPE html>
<html lang="es">
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
  <link rel="stylesheet" href="sty.css">
  <script src="//code.tidio.co/qatp5jdro988liyufwrlqw6fuciktkkp.js" async></script>
</head>
<style></style>
<body>
  <?php include 'navbar_IA.php'; ?>
  <br><br> <br><br> <br><br>



  <h1>Detección de tipo de rostro</h1>
  <br>
  <section id="demos" class="invisible">


    <p><b>Haz clic en la imagen a continuación</b> para ver un ejemplo.</p>

    <div class="detectOnClick">
      <div class="image-container">
        <img src="data:image/jpeg;base64,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" width="100%" style="width: 120%; max-width: 600px; height: auto;" crossorigin="anonymous" title="¡Haz clic para obtener la detección!" />
        <div id="image-face-shape-message" style="margin-top: 10px;"></div>
      </div>
    </div>

    <div class="container">
      <p>Mantén tu rostro frente a la webcam para obtener la detección de puntos faciales en tiempo real.</br>Haz clic en <b>activar webcam</b> a continuación y concede acceso a la webcam si se te solicita.</p>

      <div id="liveView" class="videoView">
        <button id="webcamButton" class="mdc-button mdc-button--raised">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">ACTIVAR WEBCAM</span>
        </button>
        <div class="video-container">
          <video id="webcam" autoplay playsinline></video>
          <canvas class="output_canvas" id="output_canvas" style="position: absolute; left: 0px; top: 0px;"></canvas>
          <div id="video-face-shape-message" style="margin-top: 10px;"></div>
        </div>
      </div>
    </div>

  </section>




  

    <!-- end footer -->
    <!-- Javascript files-->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/custom.js"></script>

  <script type="module" src="./script.js"></script>
</body>
</html>
