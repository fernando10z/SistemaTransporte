<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

// Obtener datos del formulario
$data = [
    'idSolicitudempresa' => $_POST['idSolicitudempresa'] ?? null,
    'idVehiculo' => $_POST['idVehiculo'] ?? null,
    'peso' => $_POST['peso'] ?? 0,
    'volumen' => $_POST['volumen'] ?? 0,
    'pesoExcedido' => $_POST['pesoExcedido'] ?? 0,
    'volumenExcedido' => $_POST['volumenExcedido'] ?? 0,
    'cargoAdicional' => $_POST['cargoAdicional'] ?? 0.00,
    'montoBase' => $_POST['montoBase'] ?? 0,
    'montoFinal' => $_POST['montoFinal'] ?? 0
];

// Validar datos
if (empty($data['idSolicitudempresa']) || empty($data['idVehiculo'])) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

try {
    // Iniciar transacción
    $conn->beginTransaction();

    // Insertar cotización
    $sql = "INSERT INTO cotizaciones_empresas (
        idSolicitudempresa, idVehiculo, peso, volumen, pesoExcedido, volumenExcedido, 
        cargoAdicional, montoBase, montoFinal, estado
    ) VALUES (
        :idSolicitudempresa, :idVehiculo, :peso, :volumen, :pesoExcedido, :volumenExcedido, 
        :cargoAdicional, :montoBase, :montoFinal, 'Pendiente'
    )";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    
    // Actualizar estado del vehículo a Ocupado
    $sqlUpdateVehiculo = "UPDATE vehiculos SET estado = 'Ocupado' WHERE idVehiculo = :idVehiculo";
    $stmtUpdateVehiculo = $conn->prepare($sqlUpdateVehiculo);
    $stmtUpdateVehiculo->execute(['idVehiculo' => $data['idVehiculo']]);
    
    // Actualizar estado de la solicitud a Cotizado
    $sqlUpdateSolicitud = "UPDATE solicitud_empresa SET estado = 'cotizado' WHERE idSolicitudempresa = :idSolicitudempresa";
    $stmtUpdateSolicitud = $conn->prepare($sqlUpdateSolicitud);
    $stmtUpdateSolicitud->execute(['idSolicitudempresa' => $data['idSolicitudempresa']]);
    
    // Confirmar transacción
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Cotización para empresa guardada exitosamente']);
} catch(PDOException $e) {
    // Revertir transacción en caso de error
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al guardar la cotización: ' . $e->getMessage()]);
}
?>