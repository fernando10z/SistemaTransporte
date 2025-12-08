<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => []];

try {
    $sql = "SELECT idServicio, nombreServicio, tipoCarga FROM servicios WHERE Estado = 'Activo' ORDER BY nombreServicio";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($servicios) {
        $response['success'] = true;
        $response['data'] = $servicios;
    } else {
        $response['message'] = 'No se encontraron servicios activos';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>