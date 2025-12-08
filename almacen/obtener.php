<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idAlmacen = $_GET['idAlmacen'];
    
    $stmt = $conn->prepare("SELECT * FROM almacen WHERE idAlmacen = :idAlmacen");
    $stmt->bindParam(':idAlmacen', $idAlmacen);
    $stmt->execute();
    
    $almacen = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($almacen) {
        echo json_encode([
            'success' => true,
            'data' => $almacen
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Almacén no encontrado'
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener el almacén: ' . $e->getMessage()
    ]);
}
?>