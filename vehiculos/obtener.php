<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("ID del vehículo no proporcionado");
    }

    $idVehiculo = intval($_GET['id']);

    // Consulta del vehículo con JOIN para obtener datos de la zona
    $sql = "SELECT v.*, z.nombreZona 
            FROM vehiculos v
            LEFT JOIN zonas_cobertura z ON v.idZona = z.idZona
            WHERE v.idVehiculo = :idVehiculo";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idVehiculo', $idVehiculo, PDO::PARAM_INT);
    $stmt->execute();
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehiculo) {
        throw new Exception("Vehículo no encontrado");
    }

    echo json_encode([
        'success' => true,
        'vehiculo' => $vehiculo
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>