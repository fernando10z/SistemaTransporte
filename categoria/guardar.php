<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idAlmacen = $_POST['idAlmacen'];
    $nombreCategoria = $_POST['nombreCategoria'];
    $descripcion = $_POST['descripcion'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("INSERT INTO categoria_producto 
                          (idAlmacen, nombreCategoria, descripcion, status) 
                          VALUES (:idAlmacen, :nombreCategoria, :descripcion, :status)");
    
    $stmt->bindParam(':idAlmacen', $idAlmacen);
    $stmt->bindParam(':nombreCategoria', $nombreCategoria);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':status', $status);
    
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Categoría registrada correctamente'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al registrar la categoría: ' . $e->getMessage()
    ]);
}
?>