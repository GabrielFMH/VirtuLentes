<?php
require_once '../../conexion/database.php';

function obtenerNotificaciones($link) {
    $notificaciones = [];

    // Consulta para productos con bajo stock
    $sql = "SELECT nombre, stock FROM productos WHERE stock <= 100";
    $result = mysqli_query($link, $sql);

    if ($result && $result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $notificaciones[] = "El producto " . $row["nombre"] . " tiene un stock bajo de " . $row["stock"] . " unidades.";
        }
    }

    return $notificaciones;
}

$link = conectarse();
$notificaciones = obtenerNotificaciones($link);
$numNotificaciones = count($notificaciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <style>
        .hidden {
            display: none;
        }
        .notification-container {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
        .notification-dropdown {
            position: absolute;
            top: 100%; /* Just below the button */
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            width: 300px; /* Ajusta según sea necesario */
            max-height: 400px; /* Ajusta según sea necesario */
            overflow-y: auto;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 100;
        }
        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .notification-item:last-child {
            border-bottom: none;
        }
        .notification-count {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 14px;
            position: absolute;
            top: -5px;
            right: -5px;
        }
    </style>
</head>
<body>
<header>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <!-- Logo section here -->
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark">
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <!-- Otros elementos de navegación aquí -->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="notification-container">
    <button id="notification-button" class="nav-link">
        <img src="../images/campana.png" alt="Notificaciones">
        <span id="notification-count" class="notification-count"><?php echo $numNotificaciones; ?></span>
    </button>
    <div id="notification-dropdown" class="notification-dropdown hidden">
        <?php if ($notificaciones): ?>
            <?php foreach ($notificaciones as $notificacion): ?>
                <div class="notification-item">
                    <?php echo $notificacion; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="no-notifications-message">No hay notificaciones nuevas.</div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('notification-button').addEventListener('click', function() {
        var dropdown = document.getElementById('notification-dropdown');
        dropdown.classList.toggle('hidden');
    });
</script>
</body>
</html>
