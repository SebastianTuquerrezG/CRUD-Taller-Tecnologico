<?php
$host = "localhost";
$user = "root";
$password = "";
$DB = "mantenimientos";

$conexion = new mysqli($host, $user, $password, $DB);
$conexion->set_charset("utf8"); 

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
