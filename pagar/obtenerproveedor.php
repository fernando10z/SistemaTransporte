<?php
header('Content-Type: application/json');

require_once '../conexion/conexion.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT * FROM proveedores 
            WHERE nombre_empresa LIKE :search 
               OR numero_ruc LIKE :search 
               OR contacto_nombre LIKE :search 
               OR contacto_telefono LIKE :search 
            ORDER BY nombre_empresa";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    
    $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($proveedores);
    
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>