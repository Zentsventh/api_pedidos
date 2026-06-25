<?php
header("Content-Type: application/json; charset=UTF-8");

// 1. Apagamos las excepciones fatales de PHP 8 para que el script no se muera en blanco
mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost";
$usuario = "zentdev_admin";
$password = "Odraude2026++";
$base_datos = "zentdev_sistema_pedidos";

// 2. Usamos el arroba (@) para ocultar las advertencias feas de PHP y mantener tu JSON limpio
$conexion = @new mysqli($host, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Error real de la BD: " . $conexion->connect_error
    ]);
    exit;
}

$conexion->set_charset("utf8mb4");
?>