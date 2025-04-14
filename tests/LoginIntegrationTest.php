<?php
use PHPUnit\Framework\TestCase;

class LoginIntegrationTest extends TestCase
{
    private $db;

    // Configuración inicial antes de cada prueba
    protected function setUp(): void
    {
        // Conectar a la base de datos de prueba
        $this->db = new mysqli('localhost', 'test_user', 'test_password', 'test_db');
        if ($this->db->connect_error) {
            $this->fail('No se pudo conectar a la base de datos de prueba');
        }
        // Limpiar la tabla de administradores
        $this->db->query("TRUNCATE TABLE administrador");
        // Iniciar la sesión manualmente
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Limpiar la sesión
        $_SESSION = [];
    }

    // Prueba 1: Autenticación exitosa
    public function testSuccessfulLogin()
    {
        // Insertar usuario de prueba
        $hashedPassword = password_hash('correct_password', PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO administrador (usuario, contrasena) VALUES ('test_user', '$hashedPassword')");

        // Simular solicitud POST
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["usuario"] = "test_user";
        $_POST["contrasena"] = "correct_password";

        // Capturar salida
        ob_start();
        include 'path/to/Logica_login.php'; // Ajusta la ruta a tu archivo
        $output = ob_get_clean();

        // Verificar resultados
        $this->assertEquals('test_user', $_SESSION['usuario'] ?? null, 'La sesión no se estableció correctamente');
        $this->assertStringNotContainsString('alert', $output, 'Se generó un mensaje de error inesperado');
    }

    // Prueba 2: Fallo de autenticación
    public function testFailedLogin()
    {
        // Insertar usuario de prueba
        $hashedPassword = password_hash('correct_password', PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO administrador (usuario, contrasena) VALUES ('test_user', '$hashedPassword')");

        // Simular solicitud POST con contraseña incorrecta
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["usuario"] = "test_user";
        $_POST["contrasena"] = "wrong_password";

        // Capturar salida
        ob_start();
        include 'path/to/Logica_login.php'; // Ajusta la ruta a tu archivo
        $output = ob_get_clean();

        // Verificar resultados
        $this->assertArrayNotHasKey('usuario', $_SESSION, 'La sesión se estableció incorrectamente');
        $this->assertStringContainsString("alert('Contraseña incorrecta')", $output, 'No se mostró el mensaje de error esperado');
    }

    // Prueba 3: Entradas vacías
    public function testEmptyCredentials()
    {
        // Simular solicitud POST con campos vacíos
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["usuario"] = "";
        $_POST["contrasena"] = "";

        // Capturar salida
        ob_start();
        include 'path/to/Logica_login.php'; // Ajusta la ruta a tu archivo
        $output = ob_get_clean();

        // Verificar resultados
        $this->assertArrayNotHasKey('usuario', $_SESSION, 'La sesión se estableció incorrectamente');
        $this->assertStringContainsString("alert('Usuario o contraseña vacíos')", $output, 'No se mostró el mensaje de error esperado');
    }

    // Limpiar después de cada prueba
    protected function tearDown(): void
    {
        $this->db->close();
        session_destroy();
    }
}