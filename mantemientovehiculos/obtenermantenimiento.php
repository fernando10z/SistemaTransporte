<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $idMantenimiento = $_POST['id'];
        
        $sql = "SELECT m.*, CONCAT(v.placa, ' - ', v.marca, ' ', v.modelo) as vehiculo
                FROM mantenimiento_vehiculo m
                JOIN vehiculos v ON m.idVehiculo = v.idVehiculo
                WHERE m.idMantenimiento = ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute([$idMantenimiento]);
        $mantenimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($mantenimiento) {
            // Formatear fechas para input type="date"
            $mantenimiento['fecha_mantenimiento'] = $mantenimiento['fecha_mantenimiento'] ? date('Y-m-d', strtotime($mantenimiento['fecha_mantenimiento'])) : '';
            $mantenimiento['fecha_proxima_mantenimiento'] = $mantenimiento['fecha_proxima_mantenimiento'] ? date('Y-m-d', strtotime($mantenimiento['fecha_proxima_mantenimiento'])) : '';
            
            echo json_encode([
                'success' => true,
                'data' => $mantenimiento
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Mantenimiento no encontrado'
            ]);
        }
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error en la base de datos: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'ID de mantenimiento no proporcionado'
    ]);
}
?>