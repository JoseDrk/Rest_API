<?php
include_once __DIR__ . '/../models/usuarioModel.php';




class AuthController {

    public function registrarUsuario($usuario, $password) {
        $usuarioModel = new UsuarioModel();
        $resultado = $usuarioModel->registrar($usuario, $password);
        echo json_encode($resultado);
    }

    public function iniciarSesion($usuario, $password) {
        $usuarioModel = new UsuarioModel();
        $resultado = $usuarioModel->login($usuario, $password);
        echo json_encode($resultado);
    }
}
?>

