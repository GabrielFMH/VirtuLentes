<?php

include '../conexion/database.php';
$conn = conectarse();

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_producto = $_POST['id_producto'];

    if (isset($_POST['upload'])) {
        // Procesar la subida del archivo
        $directorio = "../presentacion/3dmodels/"; // Ruta donde se subirán los archivos
        $archivo = $directorio . basename($_FILES['modelo3D']['name']);
        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        $dbPath = "3dmodels/" . basename($_FILES['modelo3D']['name']); // Ruta que se guardará en la BD

        // Validar que el archivo es un STL
        if ($tipoArchivo != "stl") {
            $error = "Solo se admiten archivos STL.";
        } else {
            // Mover el archivo del directorio temporal al definitivo
            if (move_uploaded_file($_FILES['modelo3D']['tmp_name'], $archivo)) {
                // Insertar la URL en la tabla modelos
                $sql = "INSERT INTO modelos (url) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $dbPath);
                $stmt->execute();
                $model_id = $stmt->insert_id;

                // Vincular el model_id con el producto
                if ($model_id) {
                    $sql = "UPDATE productos SET model_id = ? WHERE id_producto = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $model_id, $id_producto);
                    $stmt->execute();
                    
                    if ($stmt->affected_rows > 0) {
                        $mensaje = "Modelo 3D subido y vinculado correctamente.";
                    } else {
                        $error = "Error al vincular el modelo con el producto.";
                    }
                } else {
                    $error = "Error al guardar la URL del modelo en la base de datos.";
                }
                $stmt->close();
            } else {
                $error = "Hubo un error al subir el archivo.";
            }
        }
    } elseif (isset($_POST['delete'])) {
        // Procesar la eliminación del archivo
        $sql = "SELECT modelos.url, productos.model_id FROM productos 
                LEFT JOIN modelos ON productos.model_id = modelos.id
                WHERE productos.id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row && file_exists("../presentacion/" . $row['url'])) {
            unlink("../presentacion/" . $row['url']); // Eliminar archivo físico
            // Eliminar entrada en modelos y actualizar productos
            $sql = "DELETE FROM modelos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $row['model_id']);
            $stmt->execute();
            
            $sql = "UPDATE productos SET model_id = NULL WHERE id_producto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            
            $mensaje = "Modelo 3D eliminado correctamente.";
        } else {
            $error = "Archivo no encontrado.";
        }
        $stmt->close();
    }
}

// Obtener ID del producto de la URL
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>


    <main>
<head>
    <title>Administrar Modelo 3D</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="../presentacion/css/bootstrap.min.css">
   
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="../presentacion/css/responsive.css">
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="../presentacion/css/jquery.mCustomScrollbar.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../presentacion/css/font-awesome.min.css">
 
   <!-- Tabla -->
   <link rel="stylesheet" href="../presentacion/css/table.css">
</head>
<body>

        <?php include '../presentacion/admin/barra_admin.php'; ?>

    

    <h1>Administrar Modelo 3D</h1>
    <?php if (!empty($mensaje)): ?>
        <p style="color: green;"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
        <p>
            <label for="modelo3D">Subir Modelo 3D (.stl):</label>
            <input type="file" name="modelo3D" id="modelo3D" accept=".stl">
        </p>
        <p>
            <input type="submit" name="upload" value="Subir Modelo">
            <input type="submit" name="delete" value="Eliminar Modelo" onclick="return confirm('¿Está seguro de que desea eliminar el modelo 3D actual?');">
        </p>
    </form>
   
</body>
    </main>


<?php
// Cerrar la conexión
$conn->close();
?>
