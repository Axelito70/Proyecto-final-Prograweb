<?php
require_once '../config/conexion.php';
$producto = $_POST['datos'];

try {
    // Recuperamos los datos enviados
    $id = $producto[0];     
    $nombre = $producto[1]; 
    $precio = $producto[2]; 
    $unidad = $producto[3]; 
    $url = $producto[4];    
    
    // Realizamos la actualizacion
    $actualizar = $conexion->prepare("UPDATE utilidades_carros SET producto = :nombre, precio = :precio, unidad = :unidad, url = :url WHERE id = :id");
    $actualizar->bindParam(':id', $id);
    $actualizar->bindParam(':nombre', $nombre);
    $actualizar->bindParam(':precio', $precio);
    $actualizar->bindParam(':unidad', $unidad);
    $actualizar->bindParam(':url', $url);
    
    // Ejecutamos la consulta
    if ($actualizar->execute()) {
        echo json_encode([1, "Actualización correcta"]);
    } else {
        echo json_encode([0, "Actualización fallida"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
