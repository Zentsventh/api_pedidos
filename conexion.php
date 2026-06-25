<?php
header("Content-Type: application/json; charset=UTF-8");
$host = "localhost";
$usuario = "zentdev_admin";
$password = "Odraude2026++";
$base_datos = "zentdev_sistema_pedidos";
$conexion = new mysqli($host, $usuario, $password, $base_datos);
if ($conexion->connect_error) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Error de conexión a la base de datos"
    ]);
    exit;
}
$conexion->set_charset("utf8mb4");
?>
