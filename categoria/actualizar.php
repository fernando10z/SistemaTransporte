<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idCategoria = $_POST['idCategoria'];
    $idAlmacen = $_POST['idAlmacen'];
    $nombreCategoria = $_POST['nombreCategoria'];
    $descripcion = $_POST['descripcion'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE categoria_producto SET 
                          idAlmacen = :idAlmacen,
                          nombreCategoria = :nombreCategoria,
                          descripcion = :descripcion,
                          status = :status
                          WHERE idCategoria = :idCategoria");
    
    $stmt->bindParam(':idCategoria', $idCategoria);
    $stmt->bindParam(':idAlmacen', $idAlmacen);
    $stmt->bindParam(':nombreCategoria', $nombreCategoria);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':status', $status);
    
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Categoría actualizada correctamente'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar la categoría: ' . $e->getMessage()
    ]);
}
?>