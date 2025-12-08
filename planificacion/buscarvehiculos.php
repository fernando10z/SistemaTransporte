<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$idAsignacion = $_POST['idAsignacion'] ?? null;
$tipoCliente = $_POST['tipoCliente'] ?? 'natural';

try {
    if (!$idAsignacion) {
        throw new Exception('No se proporcionó ID de asignación');
    }

    if ($tipoCliente === 'natural') {
        // Obtener vehículo para cliente natural
        $sql = "SELECT v.idVehiculo, v.placa, v.marca, v.modelo
                FROM asignacion_carga_cliente a
                JOIN cotizaciones_clientes c ON a.idCotizacion = c.idCotizacion
                JOIN vehiculos v ON c.idVehiculo = v.idVehiculo
                WHERE a.idAsignacion = ?";
    } else {
        // Obtener vehículo para empresa
        $sql = "SELECT v.idVehiculo, v.placa, v.marca, v.modelo
                FROM asignacion_carga_empresa a
                JOIN cotizaciones_empresas c ON a.idCotizacionEmpresa = c.idCotizacionEmpresa
                JOIN vehiculos v ON c.idVehiculo = v.idVehiculo
                WHERE a.idAsignacionEmpresa = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$idAsignacion]);
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehiculo) {
        throw new Exception('No se encontró vehículo asociado a esta asignación');
    }

    echo json_encode([
        'success' => true,
        'data' => $vehiculo
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>