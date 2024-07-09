<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'database.php'; // Incluye el archivo de configuración de la base de datos

// Función para obtener los datos de la base de datos de usuarios
function obtenerDatosDeBaseDeDatos($conexion) {
    $query = "SELECT nombre, email FROM usuarios";
    $result = mysqli_query($conexion, $query);
    $datos = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $datos[] = $row;
        }
    }

    return $datos;
}

// Función para actualizar la notificación en la base de datos
function actualizarNotificacion($conexion, $correo) {
    $query = "UPDATE publicidad_email SET notificacion = 1 WHERE correo = '$correo'";
    mysqli_query($conexion, $query);
}

// Función para reiniciar todas las notificaciones
function reiniciarNotificaciones($conexion) {
    $query = "UPDATE publicidad_email SET notificacion = 0";
    mysqli_query($conexion, $query);
}

// Lógica para enviar el correo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedEmails = $_POST['emails'] ?? [];

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dayudi90@gmail.com';
        $mail->Password = 'btzsqohpcfrylubm'; // Asegúrate de que esta contraseña es correcta
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dayudi90@gmail.com', 'Dayudi');

        $conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);
        foreach ($selectedEmails as $email) {
            $mail->addAddress($email);
            // Actualizar notificación en la base de datos
            actualizarNotificacion($conexion, $email);
        }
        mysqli_close($conexion);

        $mail->isHTML(true);
        $mail->Subject = '¡Promoción Especial en Modelos de Lentes!';
        $mail->Body = '
            <html>
            <head>
                <title>Promoción Especial en Modelos de Lentes</title>
            </head>
            <body>
                <h1>¡Promoción Especial en Modelos de Lentes!</h1>
                <p>¡Hola! Te presentamos nuestra promoción especial en modelos selectos de lentes.</p>
                <p>No pierdas la oportunidad de obtener tus lentes favoritos a precios increíbles.</p>
                <p>Visita nuestro sitio web para ver nuestra colección completa.</p>
                <a href="https://161.132.56.43/VirtuLentes/presentacion/" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;">Visitar Sitio Web</a>
                <br><br>
                <img src="https://gmo.com.pe/media/wysiwyg/slider/2-GMO_-_Promo_Permanente_-_Banner_Home_Desktop_PE.jpg" alt="Modelo de Lentes" style="max-width: 100%;">
            </body>
            </html>
        ';
        $mail->send();

    } catch (Exception $e) {
        // Manejo de errores
    }
}

// Lógica para reiniciar las notificaciones
if (isset($_POST['reiniciar_notificaciones'])) {
    $conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);
    reiniciarNotificaciones($conexion);
    mysqli_close($conexion);
}

// Obtener datos de la base de datos
$conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$datos = obtenerDatosDeBaseDeDatos($conexion);
mysqli_close($conexion);

?>

<?php include '../admin/barra_admin.php'; ; ?>

<main>
    <link rel="stylesheet" href="../css/correo.css">
</head>

<style>
        body {
            display: flex;
            justify-content: center;



            background-color: #f0f0f0; /* Fondo para hacer más visible el contenedor */
            
        }
        .container {
            text-align: center;
            min-width: 700px; /* Ajusta el tamaño mínimo según tus necesidades */
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Añadir sombra para un mejor aspecto */
        }
    </style>

<body>
    <h1 style="text-align: center;">Ofertas vía email</h1><br>
    <div class="container" style="text-align: center;">
        <form method="post">
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato): ?>
                        <tr>
                            <td><?php echo $dato['nombre']; ?></td>
                            <td><?php echo $dato['email']; ?></td>
                            <td>
                                <input type="checkbox" name="emails[]" value="<?php echo $dato['email']; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <div style="margin-top: 20px; display: flex; gap: 20px; justify-content: center;">
                <button id="select" type="button" onclick="selectAll()">Seleccionar</button>
                <button id="deselect" type="submit" onclick="showLoader()">Enviar Correo</button>
                <button id="deselect" type="submit" name="reiniciar_notificaciones">Reiniciar Notificaciones</button>
            </div>
            <br>
        </form>
    </div>

    <!-- Overlay de carga -->
    <div class="overlay" id="overlay">
        <div class="loader"></div>
    </div>

    <script>
        function selectAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = true;
            });
        }

        function deselectAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
        }

        function showLoader() {
            document.getElementById('overlay').style.display = 'block';
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../admin/script2.js" defer></script>
    <script src="../admin/script3.js" defer></script>
</body>
</main>
