<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->query("SELECT idAlmacen, nombre FROM almacen WHERE estado = 'Activo'");
    $almacenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($almacenes);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>