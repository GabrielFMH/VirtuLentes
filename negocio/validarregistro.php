<?php
// Incluir archivo de conexión a la base de datos
include('../conexion/database.php');

// Iniciar sesión
session_start();

// Establecer la conexión
$conexion = conectarse();

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"]; // Contraseña en texto plano
    $dni = $_POST["dni"];
    $direccion = $_POST["direccion"]; // Nueva variable para la dirección

    // Validar que todos los campos obligatorios estén llenos
    if (!empty($nombre) && !empty($email) && !empty($contrasena)) {
        // Preparar la consulta SQL para insertar el nuevo usuario con dirección
        $consulta = "INSERT INTO usuarios (nombre, email, hash_contraseña, dni, direccion) 
                     VALUES ('$nombre', '$email', '$contrasena', '$dni', '$direccion')";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $consulta)) {
            // Registro exitoso, redirigir a la página de inicio de sesión
            header("Location: ../presentacion/loginusuario.php");
            exit();
        } else {
            // Error al ejecutar la consulta SQL
            echo "Error al registrar al usuario: " . mysqli_error($conexion);
        }
    } else {
        // Si no se llenaron todos los campos obligatorios, redirigir de vuelta a registrarusuario.php
        header("Location: ../presentacion/registrarusuario.php");
        exit();
    }
}
?>
