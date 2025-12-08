<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID de cliente no proporcionado');
    }

    $idCliente = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT 
            cn.idContrato,
            s.nombreServicio AS servicio,
            z.nombreZona AS zona,
            d.fechaServicio,
            d.origen,
            d.destino,
            d.peso,
            d.volumen,
            d.monto,
            cn.estado
        FROM contratos_naturales cn
        JOIN detalle_contrato_natural d ON cn.idContrato = d.idContrato
        JOIN tarifas t ON d.idTarifa = t.idTarifa
        JOIN servicios s ON t.idServicio = s.idServicio
        JOIN zonas_cobertura z ON t.idZona = z.idZona
        WHERE cn.idCliente = ?
        ORDER BY d.fechaServicio DESC
    ");
    $stmt->execute([$idCliente]);
    $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response['success'] = true;
    $response['data'] = $servicios;
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>