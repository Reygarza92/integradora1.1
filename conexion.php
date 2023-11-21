<?php
// Credenciales
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "yochambeo_db";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>