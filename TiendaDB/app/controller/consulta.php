<?php

require_once '../config/conexion.php';

try {
   
    $consulta = $conexion->prepare("SELECT * FROM utilidades_carros");
    $consulta->execute();
    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

   
    if (count($datos) > 0) {
       
        echo json_encode([1, $datos]);
    } else {
        
        echo json_encode([0, "Sin datos"]);
    }
} catch (PDOException $e) {
    
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
