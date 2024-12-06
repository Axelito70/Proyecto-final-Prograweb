<?php
$datos = json_decode($_POST['datos'], true);
require_once '../config/conexion.php';

try {
    $consulta = $_POST['datos'];
    $consulta = $conexion->prepare("SELECT * FROM t_usuarios WHERE usuario = :usuario");
    $consulta->bindParam(':usuario', $datos[2]);
    $consulta->execute();
    $consulta = $consulta->fetch(PDO::FETCH_ASSOC);
    if (!$consulta) {

        $insercion = $conexion->prepare("
        INSERT INTO t_usuarios (nombre, apellido, usuario, email, contraseña) VALUES (:nombre, :apellido, :usuario, :email, :pass)
        ");

        $insercion->bindParam(':nombre', $datos[0]);
        $insercion->bindParam(':apellido', $datos[1]);
        $insercion->bindParam(':usuario', $datos[2]);
        $insercion->bindParam(':email', $datos[3]);
        $pass = password_hash($datos[4], PASSWORD_BCRYPT);
        $insercion->bindParam(':pass', $pass);
        
        if ($insercion->execute()) {
            echo json_encode([1,"Registro correcto"]);
        }else{
            echo json_encode([0,"Registro Fallido"]);
        }
    }else{
        echo json_encode([0,"Usuario ya registrado"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
