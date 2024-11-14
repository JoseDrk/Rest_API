<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Cambiar a un dominio específico si es necesario
header('Access-Control-Allow-Methods: POST, GET');

include_once '../src/controllers/authController.php';

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'POST':
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            // Validar la existencia de usuario y password
            if (!isset($_POST['usuario']) || !isset($_POST['password'])) {
                echo json_encode(["error" => "Usuario y/o contraseña no especificados"]);
                exit();
            }

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $authController = new AuthController();

            if ($action == 'registrar') {
                $resultado = $authController->registrarUsuario($usuario, $password);
                echo json_encode(["success" => true, "mensaje" => $resultado]);
            } elseif ($action == 'login') {
                $resultado = $authController->iniciarSesion($usuario, $password);
                echo json_encode(["success" => true, "mensaje" => $resultado]);
            } else {
                echo json_encode(["error" => "Acción no válida"]);
            }
        } else {
            echo json_encode(["error" => "No se especificó la acción"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método no permitido"]);
}
?>
