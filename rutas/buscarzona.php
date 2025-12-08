<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    
    $sql = "SELECT idZona, nombreZona, departamento, provincia, distrito, Estado 
            FROM zonas_cobertura 
            WHERE (nombreZona LIKE :search OR 
                   departamento LIKE :search OR 
                   provincia LIKE :search OR 
                   distrito LIKE :search OR
                   :searchAll = '')
            ORDER BY nombreZona";
    
    $stmt = $conn->prepare($sql);
    $searchParam = "%$searchTerm%";
    $stmt->bindParam(':search', $searchParam);
    $stmt->bindParam(':searchAll', $searchTerm);
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($resultados);
    
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>