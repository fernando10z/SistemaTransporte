<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT idVehiculo, placa, marca, modelo, capacidadPeso, estado 
            FROM vehiculos 
            ORDER BY placa ASC";
            
    $stmt = $conn->query($sql);
    $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($vehiculos);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error al obtener vehículos: ' . $e->getMessage()]);
}
?>