<?php
include('../conexion/database.php');

// Establecer la conexión
$conexion = conectarse();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recuperar las credenciales del formulario
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];

  // Consulta SQL para verificar las credenciales
  $consulta = "SELECT * FROM admin WHERE usuario='$usuario' AND contraseña='$contrasena'";
  $resultado = mysqli_query($conexion, $consulta);

  // Verificar si se encontró un usuario con las credenciales proporcionadas
  if (mysqli_num_rows($resultado) == 1) {
      // Credenciales válidas, redirigir a una página nueva
      header("Location: pagina_nueva.php");
      exit();
  } else {
      // Credenciales incorrectas, mostrar mensaje de error
      echo "<script>alert('Contraseña incorrecta');</script>";
      
      // Determinar cuál campo fue incorrecto y agregar la clase 'error' a ese campo
      $error_class_usuario = $usuario == '' ? 'error' : '';
      $error_class_contrasena = $contrasena == '' ? 'error' : '';
      header("Location: ../presentacion/login.php");
      exit();
  }
}
?>