<?php
namespace Tests;

use App\LoginLogic;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $conexion;
    private $loginLogic;

    protected function setUp(): void
    {
        // Mock de la conexión mysqli
        $this->conexion = $this->createMock(\mysqli::class);
        $this->loginLogic = new LoginLogic($this->conexion);
    }

    public function testAuthenticateSuccess()
    {
        // Mock del resultado de la consulta
        $resultMock = $this->createMock(\mysqli_result::class);
        $resultMock->method('num_rows')->willReturn(1);

        // Configurar el mock de la conexión
        $this->conexion->method('query')->willReturn($resultMock);

        $result = $this->loginLogic->authenticate('admin', 'password123');

        $this->assertTrue($result['success']);
        $this->assertEquals('Login exitoso', $result['message']);
        $this->assertEquals('../presentacion/admin/index.php', $result['redirect']);
    }

    public function testAuthenticateInvalidCredentials()
    {
        // Mock del resultado de la consulta
        $resultMock = $this->createMock(\mysqli_result::class);
        $resultMock->method('num_rows')->willReturn(0);

        // Configurar el mock de la conexión
        $this->conexion->method('query')->willReturn($resultMock);

        $result = $this->loginLogic->authenticate('admin', 'wrong_password');

        $this->assertFalse($result['success']);
        $this->assertEquals('Contraseña incorrecta', $result['message']);
        $this->assertEquals('../presentacion/login.php', $result['redirect']);
    }

    public function testAuthenticateEmptyCredentials()
    {
        $result = $this->loginLogic->authenticate('', '');

        $this->assertFalse($result['success']);
        $this->assertEquals('Usuario o contraseña vacíos', $result['message']);
        $this->assertEquals('../presentacion/login.php', $result['redirect']);
    }

    public function testAuthenticateQueryFailure()
    {
        // Simular fallo en la consulta
        $this->conexion->method('query')->willReturn(false);

        $result = $this->loginLogic->authenticate('admin', 'password123');

        $this->assertFalse($result['success']);
        $this->assertEquals('Error en la consulta', $result['message']);
        $this->assertEquals('../presentacion/login.php', $result['redirect']);
    }
}