<?php

$servidor = "localhost";
$nombre_db = "inventario";
$usuario = "root";
$pass = "";

try {
    $conexion = new PDO("mysql:host=$servidor; dbname=$nombre_db;", $usuario, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>


