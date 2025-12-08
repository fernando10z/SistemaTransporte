<?php
require '../conexion/conexion.php';

$idAlmacen = $_GET['idAlmacen'] ?? 0;

try {
    $stmt = $conn->prepare("SELECT idCategoria, nombreCategoria 
                           FROM categoria_producto 
                           WHERE idAlmacen = :idAlmacen AND status = '1' 
                           ORDER BY nombreCategoria");
    $stmt->bindParam(':idAlmacen', $idAlmacen, PDO::PARAM_INT);
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($categorias);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>