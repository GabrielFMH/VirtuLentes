<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include '../conexion/database.php'; // Asegúrate de que este archivo tiene la conexión a la base de datos

// Conectar a la base de datos
$link = conectarse();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    echo "No has iniciado sesión.";
    var_dump($_SESSION); // Añadido para depuración
    exit();
}

// Obtiene los datos del usuario
$correo_usuario = $_SESSION['correo'];
$query = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $link->prepare($query);

if ($stmt === false) {
    die('Error preparando la consulta: ' . $link->error);
}

$stmt->bind_param("s", $correo_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$id_usuario = $usuario['id_usuario']; // Ahora tenemos el ID del usuario

// Actualiza los datos del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $password = $_POST['password'];

    // Si se proporciona una nueva contraseña, se almacena directamente
    if (!empty($password)) {
        $query = "UPDATE usuarios SET nombre = ?, hash_contraseña = ?, direccion = ? WHERE id_usuario = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssi", $nombre, $password, $direccion, $id_usuario);
    } else {
        $query = "UPDATE usuarios SET nombre = ?, direccion = ? WHERE id_usuario = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("ssi", $nombre, $direccion, $id_usuario);
    }

    if ($stmt === false) {
        die('Error preparando la consulta: ' . $link->error);
    }

    if ($stmt->execute()) {
        $success_message = "Datos actualizados correctamente.";
    } else {
        $error_message = "Error al actualizar los datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title><br>

     <!-- bootstrap css -->
     <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->

      <link rel="stylesheet" href="css/responsive.css">

      <link rel="stylesheet" href="css/perfilUsuario.css">
</head>
<body>
<h2>Perfil del Usuario</h2>
    <?php if (isset($success_message)) { echo "<p style='color:green;'>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>

    <form action="perfilUsuario.php" method="POST">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>">
        </div>
        <div>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Actualizar">
        </div>
    </form>
</body>
</html>
