<?php

$datos = json_decode($_POST['datos'], true);
require_once '../config/conexion.php';
session_start();

try {
    $iniciar = $_POST['datos'];
    $iniciar = $conexion->prepare("SELECT * FROM t_usuarios WHERE usuario = :usuario");
    $iniciar -> bindParam(':usuario', $datos[0]);
    $iniciar->execute();
    $iniciar = $iniciar->fetch(PDO::FETCH_ASSOC);
    if ($iniciar) {
        if (password_verify($datos[1],$iniciar['contraseña'])) {
            $_SESSION['usuario'] = $iniciar;
            
            echo json_encode([1,"Inicio de sesion exitosa"]);
        }else{
            echo json_encode([0,"Contraseña incorrecta"]);
        }
    }else{
        echo json_encode([0,"Usuario no registrado"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>