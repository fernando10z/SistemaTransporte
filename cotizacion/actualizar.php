<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$tipo = $_POST['tipo'] ?? '';
$idCotizacion = $_POST['idCotizacion'] ?? null;
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
if (empty($idCotizacion) || empty($data['idSolicitud']) || empty($data['idVehiculo']) || !in_array($tipo, ['cliente', 'empresa'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos o inválidos']);
    exit;
}

try {
    // Verificar que el vehículo existe
    $stmtVehiculo = $conn->prepare("SELECT idVehiculo FROM vehiculos WHERE idVehiculo = ?");
    $stmtVehiculo->execute([$data['idVehiculo']]);
    
    if ($stmtVehiculo->rowCount() === 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'El vehículo seleccionado no existe'
        ]);
        exit;
    }

    // Iniciar transacción
    $conn->beginTransaction();

    if ($tipo === 'cliente') {
        // Actualizar cotización para cliente natural
        $sql = "UPDATE cotizaciones_clientes SET
                idSolicitud = :idSolicitud,
                idVehiculo = :idVehiculo,
                peso = :peso,
                volumen = :volumen,
                pesoExcedido = :pesoExcedido,
                volumenExcedido = :volumenExcedido,
                cargoAdicional = :cargoAdicional,
                montoBase = :montoBase,
                montoFinal = :montoFinal
            WHERE idCotizacion = :idCotizacion";
        
        $stmt = $conn->prepare($sql);
        $data['idCotizacion'] = $idCotizacion;
        $stmt->execute($data);
        
    } else { // Empresa
        // Actualizar cotización para empresa
        $sql = "UPDATE cotizaciones_empresas SET
                idSolicitudempresa = :idSolicitud,
                idVehiculo = :idVehiculo,
                peso = :peso,
                volumen = :volumen,
                pesoExcedido = :pesoExcedido,
                volumenExcedido = :volumenExcedido,
                cargoAdicional = :cargoAdicional,
                montoBase = :montoBase,
                montoFinal = :montoFinal
            WHERE idCotizacionEmpresa = :idCotizacion";
        
        $stmt = $conn->prepare($sql);
        $data['idCotizacion'] = $idCotizacion;
        $stmt->execute($data);
    }
    
    // Confirmar transacción
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Cotización actualizada exitosamente']);
    
} catch(PDOException $e) {
    // Revertir transacción en caso de error
    $conn->rollBack();
    echo json_encode([
        'success' => false, 
        'message' => 'Error al actualizar la cotización: ' . $e->getMessage(),
        'error_details' => $e->errorInfo
    ]);
}
?>