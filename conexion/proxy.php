<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/octet-stream");

$url = "URL_DEL_MODELO_3D"; // Cambia esto a la URL del modelo 3D
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>

