<?php
namespace App;

class LoginLogic
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function authenticate($usuario, $contrasena)
    {
        if (empty($usuario) || empty($contrasena)) {
            return [
                'success' => false,
                'message' => 'Usuario o contraseña vacíos',
                'redirect' => '../presentacion/login.php'
            ];
        }

        $consulta = "SELECT * FROM administrador WHERE usuario='$usuario' AND contrasena='$contrasena'";
        $resultado = mysqli_query($this->conexion, $consulta);

        if (!$resultado) {
            return [
                'success' => false,
                'message' => 'Error en la consulta',
                'redirect' => '../presentacion/login.php'
            ];
        }

        if (mysqli_num_rows($resultado) == 1) {
            return [
                'success' => true,
                'message' => 'Login exitoso',
                'redirect' => '../presentacion/admin/index.php'
            ];
        }

        return [
            'success' => false,
            'message' => 'Contraseña incorrecta',
            'redirect' => '../presentacion/login.php'
        ];
    }

    public function handleLogin()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $usuario = $_POST["usuario"] ?? '';
        $contrasena = $_POST["contrasena"] ?? '';

        $result = $this->authenticate($usuario, $contrasena);

        if ($result['success']) {
            $_SESSION['usuario'] = $usuario;
        } else {
            echo "<script>alert('{$result['message']}');</script>";
        }

        header("Location: {$result['redirect']}");
        exit();
    }
}