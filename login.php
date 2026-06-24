<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "mensaje" => "Método no permitido"
    ]);
    exit;
}

$usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : "";
$password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

if ($usuario == "" || $password == "") {
    echo json_encode([
        "success" => false,
        "mensaje" => "Usuario y contraseña son obligatorios"
    ]);
    exit;
}

$sql = "SELECT 
            u.id_usuario,
            u.nombres,
            u.apellidos,
            u.correo,
            u.usuario,
            u.password,
            u.estado,
            r.nombre AS rol
        FROM usuarios u
        INNER JOIN roles r ON u.id_rol = r.id_rol
        WHERE u.usuario = ?
        LIMIT 1";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Usuario no existe"
    ]);
    exit;
}

$fila = $resultado->fetch_assoc();

if ($fila["password"] != $password) {
    echo json_encode([
        "success" => false,
        "mensaje" => "Contraseña incorrecta"
    ]);
    exit;
}

if ($fila["estado"] != "ACTIVO") {
    echo json_encode([
        "success" => false,
        "mensaje" => "Usuario inactivo"
    ]);
    exit;
}

echo json_encode([
    "success" => true,
    "mensaje" => "Login correcto",
    "id_usuario" => $fila["id_usuario"],
    "nombres" => $fila["nombres"],
    "apellidos" => $fila["apellidos"],
    "correo" => $fila["correo"],
    "usuario" => $fila["usuario"],
    "rol" => $fila["rol"]
]);

$stmt->close();
$conexion->close();

?>
