<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idAlmacen = $_POST['idAlmacen'];
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];
    
    $stmt = $conn->prepare("UPDATE almacen SET 
                            nombre = :nombre, 
                            ubicacion = :ubicacion, 
                            estado = :estado 
                            WHERE idAlmacen = :idAlmacen");
    
    $stmt->bindParam(':idAlmacen', $idAlmacen);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':estado', $estado);
    
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Almacén actualizado correctamente'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar el almacén: ' . $e->getMessage()
    ]);
}
?>