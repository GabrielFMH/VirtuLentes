<?php
include('../conexion/database.php');

// Iniciar sesión
session_start();

// Establecer la conexión
$conexion = conectarse();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar las credenciales del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Consulta SQL para verificar las credenciales
    $consulta = "SELECT * FROM usuarios WHERE nombre='$usuario' AND hash_contraseña='$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if (mysqli_num_rows($resultado) == 1) {
        // Credenciales válidas, almacenar información del usuario en la sesión
        $usuario_info = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario'] = $usuario_info['nombre'];
        $_SESSION['correo'] = $usuario_info['email'];

        // Redirigir a una página nueva
        header("Location: ../presentacion/index.php");
        exit();
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        echo "<script>alert('Contraseña incorrecta');</script>";

        // Redirigir de vuelta a la página de inicio de sesión
        header("Location: ../presentacion/loginusuario.php");
        exit();
    }
}
?>
