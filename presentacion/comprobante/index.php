<?php
session_start();

// Verificar si la sesión del usuario está activa
$nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuario";
$correo_usuario = isset($_SESSION['correo']) ? $_SESSION['correo'] : "usuario@gmail.com";
$sesion_activa = isset($_SESSION['usuario']);

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

// Preparar la consulta para obtener los detalles del pedido
$sql = "SELECT pedidos.id_pedido, pedidos.fecha_pedido, pedidos.estado, pedidos.direccion, 
                detalle_pedido.cantidad, detalle_pedido.precio, productos.nombre AS nombre_producto,
                productos.modelo_url
        FROM pedidos
        JOIN detalle_pedido ON pedidos.id_pedido = detalle_pedido.id_pedido
        JOIN productos ON detalle_pedido.id_producto = productos.id_producto
        WHERE pedidos.id_pedido = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;

// Inicializar variable para el contenido del correo
$email_content = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 0 auto; }
        .header { background-color: #f8f8f8; padding: 10px; text-align: center; }
        .order-details { margin: 10px 0; }
        .order-item { border-bottom: 1px solid #ddd; padding: 5px 0; }
        .order-item:last-child { border-bottom: none; }
        .order-item img { max-width: 100px; }
        .order-item div { display: inline-block; vertical-align: top; }
        .order-item .details { margin-left: 10px; }
        .footer { background-color: #f8f8f8; padding: 10px; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
   <br>
    <img src='https://i.ibb.co/CsKnD07/virtu-Logo.png' alt='virtu-Logo' border='0' width='100px' height='100px'>
    <div class='container'>
        <div class='header'>
            <h2>Detalles del Pedido</h2>
            <p>Hola, $nombre_usuario. Aquí están los detalles de su pedido.</p>
        </div>
        <div class='order-details'>
            <h3>Pedido #$pedido_id</h3>
";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subtotal_item = $row['cantidad'] * $row['precio'];
        $total += $subtotal_item;
        $email_content .= "
            <div class='order-item'>
                <img src='{$row['modelo_url']}' alt='Imagen del Producto' width='200px' height='200px'>
                <div class='details'>
                    <p><strong>Producto:</strong> {$row['nombre_producto']}</p>
                    <p><strong>Fecha del Pedido:</strong> {$row['fecha_pedido']}</p>
                    <p><strong>Estado:</strong> {$row['estado']}</p>
                    <p><strong>Dirección:</strong> {$row['direccion']}</p>
                    <p><strong>Cantidad:</strong> {$row['cantidad']}</p>
                    <p><strong>Precio Unitario:</strong> \${$row['precio']}</p>
                    <p><strong>Subtotal:</strong> \$" . number_format($subtotal_item, 2) . "</p>
                </div>
            </div>
        ";
    }
    $subtotal = $total / 1.18;
    $email_content .= "
            <div class='order-item'>
                <p><strong>Subtotal:</strong> \$" . number_format($subtotal, 2) . "</p>
                <p><strong>Total:</strong> \$" . number_format($total, 2) . "</p>
            </div>
    ";
} else {
    $email_content .= "<p>No se encontraron detalles para este pedido.</p>";
}

$email_content .= "
        </div>
        <div class='footer'>
            <p>Gracias por su compra. Si tiene alguna pregunta, no dude en contactarnos.</p>
        </div>
    </div>
</body>
</html>
";

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
    echo 'GRACIAS POR SU COMPRA, el comprobante de pago fue enviado a su correo :)';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
