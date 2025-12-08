<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $data = [
        'idSubcategoria' => $_POST['idSubcategoria'],
        'idAlmacen' => $_POST['idAlmacen'],
        'idCategoria' => $_POST['idCategoria'],
        'nomArea' => $_POST['nomArea'],
        'descripcion' => $_POST['descripcion'],
        'status' => $_POST['status']
    ];
    
    $sql = "UPDATE subcategoria SET 
            idAlmacen = :idAlmacen,
            idCategoria = :idCategoria,
            nomArea = :nomArea,
            descripcion = :descripcion,
            status = :status
            WHERE idsubcategoria = :idSubcategoria";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    
    echo json_encode([
        'success' => true,
        'message' => 'Subcategoría actualizada correctamente'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>