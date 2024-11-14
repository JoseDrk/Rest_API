<?php
$host = 'localhost';
$dbname = 'login';
$username = 'root';
$password = '123456';

try {
    //  variables definidas para la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
