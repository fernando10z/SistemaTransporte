<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID de empresa no proporcionado');
    }

    $idEmpresa = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT 
            ce.idContratoempresa AS idContrato,
            d.servicio,
            d.Zona AS zona,
            d.fechaServicio,
            d.origen,
            d.destino,
            d.peso,
            d.volumen,
            d.monto,
            ce.estado
        FROM contratos_empresas ce
        JOIN detalle_contrato_empresa d ON ce.idContratoempresa = d.idContratoempresa
        WHERE ce.idEmpresa = ?
        ORDER BY d.fechaServicio DESC
    ");
    $stmt->execute([$idEmpresa]);
    $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response['success'] = true;
    $response['data'] = $servicios;
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>