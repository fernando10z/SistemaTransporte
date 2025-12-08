<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => []];

try {
    $sql = "SELECT idZona, nombreZona, departamento, provincia, distrito 
            FROM zonas_cobertura 
            WHERE Estado = 'Activo'
            ORDER BY nombreZona";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $zonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($zonas) {
        $response['success'] = true;
        $response['data'] = $zonas;
    } else {
        $response['message'] = 'No se encontraron zonas activas';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>