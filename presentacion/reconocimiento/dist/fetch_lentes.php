<?php
include 'database.php';

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    $stmt = $pdo->prepare('SELECT nombre, precio FROM productos WHERE id_tipo = (SELECT id_tipo FROM tipo_rostro WHERE tipo = ?)');
    $stmt->execute([$tipo]);

    $lentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'lentes' => $lentes]);
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de rostro no proporcionado.']);
}
?>
