<?php
require '../conexion/conexion.php';

$idAlmacen = $_GET['idAlmacen'] ?? 0;
$idCategoria = $_GET['idCategoria'] ?? 0;
$idSubcategoria = $_GET['idSubcategoria'] ?? 0;

try {
    $stmt = $conn->prepare("SELECT idProducto, codigoProducto, nombreProducto, stock, stock_minimo 
                           FROM producto 
                           WHERE idAlmacen = :idAlmacen 
                           AND idCategoria = :idCategoria 
                           AND idsubcategoria = :idSubcategoria 
                           AND status = 'Activo' 
                           ORDER BY nombreProducto");
    $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
    $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
    $stmt->bindParam(':idSubcategoria', $idSubcategoria, PDO::PARAM_INT);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($productos);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>