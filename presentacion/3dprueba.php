<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Modelo 3D STL</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { margin: 0; }
        canvas { display: block; }
    </style>
</head>
<body>
    <a class="btn btn-primary" href="glasses.php">Volver</a>
    <h1>MODELO 3D:</h1>
    <?php
    include '../conexion/database.php'; // Incluir el archivo de conexión

    // Crear conexión
    $conn = conectarse();

    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 2; // Obtener el ID del producto de la URL

    $sql = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, p.id_categoria, m.url as modelo_url
            FROM productos p
            LEFT JOIN modelos m ON p.model_id = m.id
            WHERE p.id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $model_url = $row['modelo_url'];
    } else {
        $model_url = null;
    }

    $stmt->close();
    $conn->close();
    ?>
    <script>
        const modelUrl = <?php echo json_encode($model_url); ?>;
        const productId = <?php echo json_encode($product_id); ?>;
    </script>
    <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>
    <script type="importmap">
        {
          "imports": {
            "three": "https://unpkg.com/three@v0.163.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@v0.163.0/examples/jsm/"
          }
        }
    </script>
    <script type="module" src="app.js"></script>
</body>
</html>
