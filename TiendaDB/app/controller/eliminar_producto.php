<?php

require_once '../config/conexion.php';

try {
    $id = $_GET['id'];

    $eliminar = $conexion->prepare("DELETE FROM utilidades_carros WHERE id = :id");
    
  
    $eliminar->bindParam(':id', $id);
    
    // Ejecutamos la consulta
    if ($eliminar->execute()) {
        echo json_encode([1, "Eliminación exitosa"]);
    } else {
       
        echo json_encode([0, "Error al eliminar el producto"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>
