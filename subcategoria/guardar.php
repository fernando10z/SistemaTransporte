<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idSubcategoria = !empty($_POST['idSubcategoria']) ? $_POST['idSubcategoria'] : null;
    $idAlmacen = $_POST['idAlmacen'];
    $idCategoria = $_POST['idCategoria'];
    $nomArea = $_POST['nomArea'];
    $descripcion = $_POST['descripcion'];
    $status = $_POST['status'];
    
    if (empty($idSubcategoria)) {
        // Insertar nueva subcategoría
        $stmt = $conn->prepare("
            INSERT INTO subcategoria 
            (idAlmacen, idCategoria, nomArea, descripcion, status) 
            VALUES (:idAlmacen, :idCategoria, :nomArea, :descripcion, :status)
        ");
    } else {
        // Actualizar subcategoría existente
        $stmt = $conn->prepare("
            UPDATE subcategoria SET 
            idAlmacen = :idAlmacen,
            idCategoria = :idCategoria,
            nomArea = :nomArea,
            descripcion = :descripcion,
            status = :status
            WHERE idsubcategoria = :idSubcategoria
        ");
        $stmt->bindParam(':idSubcategoria', $idSubcategoria);
    }
    
    $stmt->bindParam(':idAlmacen', $idAlmacen);
    $stmt->bindParam(':idCategoria', $idCategoria);
    $stmt->bindParam(':nomArea', $nomArea);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':status', $status);
    
    $stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => 'Subcategoría guardada correctamente'
    ]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar: ' . $e->getMessage()
    ]);
}
?>