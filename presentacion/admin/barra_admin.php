<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Asegúrate de redirigir al usuario si no está autenticado
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtulentes - Panel de Administración</title>
    <link rel="stylesheet" href="../css/index_admin.css">
    <script src="https://code.ionicframework.com/ionicons/2.0.1/ionicons.min.js"></script> <!-- Inclusión de Ionicons -->
</head>
<body>
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div class="nombre-pagina">
            <ion-icon id="cloud" name="cloud-outline"></ion-icon>
            <span>Virtulentes</span>
        </div>
        <button class="boton">
            <ion-icon name="add-outline"></ion-icon>
            <span>Gestionar</span>
        </button>

        <nav class="navegacion">
            <ul>
                <li><a id="inbox" href="/VirtuLentes/presentacion/admin/index.php"><ion-icon name="mail-unread-outline"></ion-icon><span>Pedidos</span></a></li>
                <li><a href="/VirtuLentes/presentacion/admin/estadisticas.php"><ion-icon name="stats-chart-outline"></ion-icon><span>Estadísticas</span></a></li>
                <li><a href="/VirtuLentes/presentacion/correo/index.php"><ion-icon name="send-outline"></ion-icon><span>Publicidad</span></a></li>
                <li><a href="/VirtuLentes/presentacion/admin/crudProductos.php"><ion-icon name="layers-outline"></ion-icon><span>Productos</span></a></li>
                <li><a href="/VirtuLentes/negocio/salir_admin.php"><ion-icon name="exit-outline"></ion-icon><span>Salir</span></a></li>
                <!-- Eliminar enlaces no utilizados o completar sus href correctamente -->
            </ul>
        </nav>
        <div class="linea"></div>
        <div class="modo-oscuro">
            <div class="info">
                <ion-icon name="moon-outline"></ion-icon>
                <span>Dark Mode</span>
            </div>
            <div class="switch">
                <div class="base">
                    <div class="circulo"></div>
                </div>
            </div>
        </div>

        <div class="usuario">
            <div class="info-usuario">
                <div class="nombre-email">
                    <span class="nombre"><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                </div>
                <ion-icon name="ellipsis-vertical-outline"></ion-icon>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script2.js" defer></script>
    <script src="script3.js" defer></script>

</body>
</html>
