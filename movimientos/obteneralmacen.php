<?php
require '../conexion/conexion.php';

try {
    $stmt = $conn->prepare("SELECT idAlmacen, nombre FROM almacen WHERE estado = 'Activo' ORDER BY nombre");
    $stmt->execute();
    $almacenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($almacenes);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>