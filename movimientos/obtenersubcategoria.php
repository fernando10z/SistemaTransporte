<?php
require '../conexion/conexion.php';

$idAlmacen = $_GET['idAlmacen'] ?? 0;
$idCategoria = $_GET['idCategoria'] ?? 0;

try {
    $stmt = $conn->prepare("SELECT idsubcategoria, nomArea 
                           FROM subcategoria 
                           WHERE idAlmacen = :idAlmacen AND idCategoria = :idCategoria AND status = '1' 
                           ORDER BY nomArea");
    $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
    $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
    $stmt->execute();
    $subcategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($subcategorias);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>