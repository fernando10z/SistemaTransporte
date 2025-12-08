<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idAlmacen = $_GET['idAlmacen'] ?? 0;
    
    $stmt = $conn->prepare("SELECT idCategoria, nombreCategoria, descripcion 
                           FROM categoria_producto 
                           WHERE idAlmacen = ? AND status = '1'");
    $stmt->execute([$idAlmacen]);
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($categorias);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>