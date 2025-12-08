<?php
require_once '../conexion/conexion.php';

$idAlmacen = $_GET['idAlmacen'] ?? null;
$idCategoria = $_GET['idCategoria'] ?? null;

if (!$idAlmacen || !$idCategoria) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

try {
    $query = "SELECT idsubcategoria, nomArea as nombreSubcategoria 
              FROM subcategoria 
              WHERE idAlmacen = :idAlmacen AND idCategoria = :idCategoria AND status = '1'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
    $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
    $stmt->execute();
    $subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $subcategorias
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar subcategorías: ' . $e->getMessage()
    ]);
}
?>