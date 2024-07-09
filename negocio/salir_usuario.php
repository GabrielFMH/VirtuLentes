<?php
// Iniciar sesión
session_start();

// Cerrar sesión si está activa
if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']); // Eliminar la variable de sesión 'usuario'
    unset($_SESSION['correo']);  // Eliminar la variable de sesión 'correo'
    session_destroy(); // Destruir la sesión
}

// Redirigir a otra página
header("Location: ../presentacion/index.php");
exit();
?>
