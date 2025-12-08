<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

// Obtener datos del formulario
$tipo = $_POST['tipo'] ?? '';
$data = [
    'idSolicitud' => $_POST['idSolicitud'] ?? ($_POST['idSolicitudempresa'] ?? null),
    'idVehiculo' => $_POST['idVehiculo'] ?? null,
    'peso' => $_POST['peso'] ?? 0,
    'volumen' => $_POST['volumen'] ?? 0,
    'pesoExcedido' => $_POST['pesoExcedido'] ?? 0,
    'volumenExcedido' => $_POST['volumenExcedido'] ?? 0,
    'cargoAdicional' => $_POST['cargoAdicional'] ?? 0.00,
    'montoBase' => $_POST['montoBase'] ?? 0,
    'montoFinal' => $_POST['montoFinal'] ?? 0
];

// Validar datos básicos
if (empty($data['idSolicitud']) || empty($data['idVehiculo']) || !in_array($tipo, ['cliente', 'empresa'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos o inválidos']);
    exit;
}

try {
    // Verificar que el vehículo existe y está disponible
    $stmtVehiculo = $conn->prepare("SELECT idVehiculo FROM vehiculos WHERE idVehiculo = ? AND estado = 'Disponible'");
    $stmtVehiculo->execute([$data['idVehiculo']]);
    
    if ($stmtVehiculo->rowCount() === 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'El vehículo seleccionado no existe o no está disponible'
        ]);
        exit;
    }

    // Verificar que la solicitud existe y está pendiente
    $tablaSolicitud = ($tipo === 'cliente') ? 'solicitudes_clientes' : 'solicitud_empresa';
    $campoSolicitud = ($tipo === 'cliente') ? 'idSolicitud' : 'idSolicitudempresa';
    $estadoSolicitud = ($tipo === 'cliente') ? 'Pendiente' : 'pendiente';

    $stmtSolicitud = $conn->prepare("SELECT $campoSolicitud FROM $tablaSolicitud WHERE $campoSolicitud = ? AND estado = ?");
    $stmtSolicitud->execute([$data['idSolicitud'], $estadoSolicitud]);
    
    if ($stmtSolicitud->rowCount() === 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'La solicitud seleccionada no existe o ya fue procesada'
        ]);
        exit;
    }

    // Iniciar transacción
    $conn->beginTransaction();

    if ($tipo === 'cliente') {
        // Insertar cotización para cliente natural
        $sql = "INSERT INTO cotizaciones_clientes (
            idSolicitud, idVehiculo, peso, volumen, pesoExcedido, volumenExcedido, 
            cargoAdicional, montoBase, montoFinal, estado
        ) VALUES (
            :idSolicitud, :idVehiculo, :peso, :volumen, :pesoExcedido, :volumenExcedido, 
            :cargoAdicional, :montoBase, :montoFinal, 'Pendiente'
        )";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        
        // Actualizar estado de la solicitud
        $sqlUpdateSolicitud = "UPDATE solicitudes_clientes SET estado = 'cotizado' WHERE idSolicitud = :idSolicitud";
        $stmtUpdateSolicitud = $conn->prepare($sqlUpdateSolicitud);
        $stmtUpdateSolicitud->execute(['idSolicitud' => $data['idSolicitud']]);
        
    } else { // Empresa
        // Insertar cotización para empresa
        $sql = "INSERT INTO cotizaciones_empresas (
            idSolicitudempresa, idVehiculo, peso, volumen, pesoExcedido, volumenExcedido, 
            cargoAdicional, montoBase, montoFinal, estado
        ) VALUES (
            :idSolicitud, :idVehiculo, :peso, :volumen, :pesoExcedido, :volumenExcedido, 
            :cargoAdicional, :montoBase, :montoFinal, 'Pendiente'
        )";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        
        // Actualizar estado de la solicitud
        $sqlUpdateSolicitud = "UPDATE solicitud_empresa SET estado = 'cotizado' WHERE idSolicitudempresa = :idSolicitud";
        $stmtUpdateSolicitud = $conn->prepare($sqlUpdateSolicitud);
        $stmtUpdateSolicitud->execute(['idSolicitud' => $data['idSolicitud']]);
    }
    
    // Actualizar estado del vehículo (para ambos tipos)
    $sqlUpdateVehiculo = "UPDATE vehiculos SET estado = 'Ocupado' WHERE idVehiculo = :idVehiculo";
    $stmtUpdateVehiculo = $conn->prepare($sqlUpdateVehiculo);
    $stmtUpdateVehiculo->execute(['idVehiculo' => $data['idVehiculo']]);
    
    // Confirmar transacción
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Cotización guardada exitosamente']);
    
} catch(PDOException $e) {
    // Revertir transacción en caso de error
    $conn->rollBack();
    echo json_encode([
        'success' => false, 
        'message' => 'Error al guardar la cotización: ' . $e->getMessage(),
        'error_details' => $e->errorInfo
    ]);
}
?>