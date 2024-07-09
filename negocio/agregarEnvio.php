<?php
ob_start();

function actualizarPedido($link, $idPedido) {
    $fechaEntrega = date('Y-m-d');
    $sql = "UPDATE pedidos SET estado = 'completado', `fecha_entrega` = ? WHERE `id_pedido` = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $fechaEntrega, $idPedido);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        die("Error: No se proporcionó el ID del pedido.");
    }
    $idPedido = $_POST['id'];
    require_once 'C:\xampp\htdocs\VirtuLentes\conexion\database.php';
    $link = conectarse();

    try {
        actualizarPedido($link, $idPedido);

        echo "<script type='text/javascript'>
            window.open('../notificacionEnvio/index.php?pedido_id={$idPedido}', '_blank');
            window.location.href = '/VirtuLentes/presentacion/admin/index.php';
        </script>";
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        mysqli_close($link);
    }
} else {
    header('Location: /VirtuLentes/presentacion/admin/index.php');
    exit;
}

ob_end_flush();
?>
