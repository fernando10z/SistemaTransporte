<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    // Obtener datos del POST
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        throw new Exception('No se recibieron datos del formulario');
    }
    
    // Validar datos básicos
    if (empty($data['idClienteEmpresa']) || empty($data['estado']) || empty($data['servicios'])) {
        throw new Exception('Faltan datos obligatorios: empresa, estado o servicios');
    }
    
    $conn->beginTransaction();
    
    // 1. Insertar en contratos_empresas
    $stmtContrato = $conn->prepare("INSERT INTO contratos_empresas (idEmpresa, estado) VALUES (?, ?)");
    $stmtContrato->execute([$data['idClienteEmpresa'], $data['estado']]);
    $idContrato = $conn->lastInsertId();
    
    // 2. Insertar detalles del contrato
    $stmtDetalle = $conn->prepare("INSERT INTO detalle_contrato_empresa 
        (idContratoempresa, idTarifa, servicio, Zona, fechaServicio, descripcion, origen, destino, peso, volumen, monto) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($data['servicios'] as $servicio) {
        // Validar campos obligatorios del servicio
        if (empty($servicio['idTarifa']) || empty($servicio['servicio']) || empty($servicio['zona']) || 
            empty($servicio['fechaServicio']) || empty($servicio['origen']) || 
            empty($servicio['destino']) || empty($servicio['monto'])) {
            throw new Exception('Faltan datos obligatorios en uno de los servicios');
        }
        
        $stmtDetalle->execute([
            $idContrato,
            $servicio['idTarifa'],
            $servicio['servicio'],
            $servicio['zona'],
            $servicio['fechaServicio'],
            $servicio['descripcion'] ?? null,
            $servicio['origen'],
            $servicio['destino'],
            !empty($servicio['peso']) ? $servicio['peso'] : null,
            !empty($servicio['volumen']) ? $servicio['volumen'] : null,
            $servicio['monto']
        ]);
    }
    
    $conn->commit();
    
    $response['success'] = true;
    $response['message'] = 'Contrato para empresa registrado exitosamente';
    $response['idContrato'] = $idContrato;
    
} catch (PDOException $e) {
    $conn->rollBack();
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>