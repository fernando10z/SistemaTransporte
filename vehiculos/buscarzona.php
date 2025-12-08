<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $soloActivos = isset($_GET['activos']) && $_GET['activos'] == '1';
    
    $sql = "SELECT * FROM zonas_cobertura WHERE 1=1";
    
    if (!empty($searchTerm)) {
        $sql .= " AND (nombreZona LIKE :search OR departamento LIKE :search OR provincia LIKE :search OR distrito LIKE :search)";
    }
    
    if ($soloActivos) {
        $sql .= " AND Estado = 'Activo'";
    }
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($searchTerm)) {
        $searchParam = "%$searchTerm%";
        $stmt->bindParam(':search', $searchParam);
    }
    
    $stmt->execute();
    $zonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($zonas);
    
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>