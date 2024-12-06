<?php

require_once '../config/conexion.php';

try {
    $id = $_GET['id'];
    $consulta = $conexion->prepare("SELECT * FROM utilidades_carros WHERE id = :id");
    
    $consulta->bindParam(':id', $id);
    
    $consulta->execute();
    
    $datos = $consulta->fetch(PDO::FETCH_ASSOC);
    
    
    if ($datos) {
        echo json_encode([1, $datos]);
    } else {
       
        echo json_encode([0, "Producto no encontrado"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
