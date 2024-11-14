<?php
class UsuarioModel {

    private $pdo;

    public function __construct() {
        // Ajustar la ruta para incluir correctamente db.php
        include_once __DIR__ . '/../../db/db.php';
        $this->pdo = $pdo;
    }

    // Registrar un nuevo usuario
    public function registrar($usuario, $password) {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, password) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$usuario, $passwordHash]);
            return ["mensaje" => "Usuario registrado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al registrar: " . $e->getMessage()];
        }
    }

    // Iniciar sesión con usuario y contraseña
    public function login($usuario, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$usuario]);
            $usuarioDb = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioDb && password_verify($password, $usuarioDb['password'])) {
                return ["mensaje" => "Autenticación satisfactoria"];
            } else {
                return ["error" => "Autenticación fallida"];
            }
        } catch (PDOException $e) {
            return ["error" => "Error en login: " . $e->getMessage()];
        }
    }
}
?>
