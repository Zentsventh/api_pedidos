<?php
$url = "https://zentdev.store/api_pedidos/login.php";
$datos = [
    "usuario" => "admin",
    "password" => "123456"
];
$opciones = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-type: application/x-www-form-urlencoded",
        "content" => http_build_query($datos)
    ]
];
$contexto = stream_context_create($opciones);
$respuesta = file_get_contents($url, false, $contexto);
echo $respuesta;
?>
