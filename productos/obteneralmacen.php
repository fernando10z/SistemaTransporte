<?php
require_once '../conexion/conexion.php';

try {
    $query = "SELECT idAlmacen, nombre as nombreAlmacen FROM almacen WHERE estado = 'Activo'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $almacenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $almacenes
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar almacenes: ' . $e->getMessage()
    ]);
}
?>