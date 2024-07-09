<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include '../../conexion/database.php';

// Establecer la conexión con la base de datos
$conn = conectarse();

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Recuperar el ID del pedido de la URL
$pedido_id = $_GET['pedido_id'];

// Preparar la consulta para obtener los detalles del pedido y la información del usuario
$sql = "SELECT pedidos.fecha_pedido, productos.nombre AS nombre_producto, productos.modelo_url,
                usuarios.nombre AS nombre_usuario, usuarios.email AS correo_usuario
        FROM pedidos
        JOIN detalle_pedido ON pedidos.id_pedido = detalle_pedido.id_pedido
        JOIN productos ON detalle_pedido.id_producto = productos.id_producto
        JOIN usuarios ON pedidos.id_usuario = usuarios.id_usuario
        WHERE pedidos.id_pedido = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparando la consulta: " . $conn->error;
    exit;
}

$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['nombre_usuario'];
    $correo_usuario = $row['correo_usuario'];
    $nombre_producto = $row['nombre_producto'];
    $modelo_url = $row['modelo_url'];
    $fecha_pedido = $row['fecha_pedido'];

    // Preparar el contenido del correo electrónico
    $email_content = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { width: 80%; margin: 0 auto; padding: 20px; text-align: center; }
            .header { background-color: #f8f8f8; padding: 10px; }
            .order-details { margin-top: 20px; }
            .order-item img { max-width: 100px; margin-top: 10px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <img src='https://i.ibb.co/CsKnD07/virtu-Logo.png' alt='VirtuLentes Logo' width='100px' height='100px'>
            <h1>Confirmación de Envío</h1>
            <p>Hola, $nombre_usuario,</p>
            <p>Tu compra ha sido enviada el $fecha_pedido.</p>
            <div class='order-details'>
                <h3>Detalles del Producto:</h3>
                <img src='$modelo_url' alt='Producto'>
                <p>$nombre_producto</p>
            </div>
        </div>
    </body>
    </html>
    ";}
  // Cerrar el statement y la conexión
$stmt->close();
$conn->close();

// Incluir y configurar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dayudi90@gmail.com'; // Reemplaza con tu dirección de correo
    $mail->Password = 'btzsqohpcfrylubm'; // Reemplaza con tu contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatarios
    $mail->setFrom('dayudi90@gmail.com', 'VirtuLentes'); // Reemplaza con tu dirección de correo
    $mail->addAddress($correo_usuario, $nombre_usuario);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Detalles de su Pedido #' . $pedido_id;
    $mail->Body    = nl2br($email_content); // Convertir saltos de línea a <br>

    // Enviar correo
    $mail->send();
    echo 'Confirmacion de envio fue enviado exitosamente :)';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
