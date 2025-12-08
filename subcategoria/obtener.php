<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idSubcategoria = $_GET['idSubcategoria'] ?? 0;
    
    $stmt = $conn->prepare("
        SELECT s.*, c.nombreCategoria 
        FROM subcategoria s
        JOIN categoria_producto c ON s.idCategoria = c.idCategoria
        WHERE s.idsubcategoria = ?
    ");
    $stmt->execute([$idSubcategoria]);
    $subcategoria = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($subcategoria) {
        echo json_encode([
            'success' => true,
            'idSubcategoria' => $subcategoria['idsubcategoria'],
            'idAlmacen' => $subcategoria['idAlmacen'],
            'idCategoria' => $subcategoria['idCategoria'],
            'nombreCategoria' => $subcategoria['nombreCategoria'],
            'nomArea' => $subcategoria['nomArea'],
            'descripcion' => $subcategoria['descripcion'],
            'status' => $subcategoria['status']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Subcategoría no encontrada'
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>