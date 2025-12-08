<?php
require_once '../conexion/conexion.php';

$idAlmacen = $_GET['idAlmacen'] ?? null;

if (!$idAlmacen) {
    echo json_encode(['success' => false, 'message' => 'ID de almacén no proporcionado']);
    exit;
}

try {
    $query = "SELECT idCategoria, nombreCategoria 
              FROM categoria_producto 
              WHERE idAlmacen = :idAlmacen AND status = '1'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $categorias
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar categorías: ' . $e->getMessage()
    ]);
}
?>