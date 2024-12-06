<?php 
$producto = json_decode($_POST['producto'], true);
require_once '../config/conexion.php';

try {
    // Recuperamos los datos del producto
    $nombre = $producto[0];  
    $precio = $producto[1];  
    $unidad = $producto[2];  
    $url = $producto[3];     
    $fecha_agregado = $producto[4]; 

    // Realizamos la inserción en la base de datos
    $insercion = $conexion->prepare("INSERT INTO utilidades_carros (producto, precio, unidad, url, fecha_agregado) VALUES (:nombre, :precio, :unidad, :url, :fecha_agregado)");
    $insercion->bindParam(':nombre', $nombre);
    $insercion->bindParam(':precio', $precio);
    $insercion->bindParam(':unidad', $unidad);
    $insercion->bindParam(':url', $url);
    $insercion->bindParam(':fecha_agregado', $fecha_agregado);
    
    // Ejecutamos la consulta
    if ($insercion->execute()) {
        echo json_encode(["status" => "success", "data" => $producto]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al insertar el producto"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
