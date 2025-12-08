<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

try {
    // Obtener estados de vehículos
    $sql = "SELECT 
                estado,
                COUNT(*) as cantidad
            FROM vehiculos 
            GROUP BY estado";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $valores = [];
    
    foreach ($resultados as $row) {
        $labels[] = $row['estado'];
        $valores[] = intval($row['cantidad']);
    }
    
    // Si no hay datos
    if (empty($labels)) {
        $labels = ['Sin vehículos'];
        $valores = [0];
    }
    
    echo json_encode([
        'labels' => $labels,
        'valores' => $valores
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener datos de vehículos',
        'labels' => ['Sin datos'],
        'valores' => [0]
    ]);
}
?>