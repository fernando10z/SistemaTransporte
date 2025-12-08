<?php
require '../conexion/conexion.php';

$tipoCliente = $_POST['tipoCliente'];
$idCotizacion = $_POST['idCotizacion'];
$tablaAsignacion = $_POST['tablaAsignacion'];
$observaciones = $_POST['observaciones'];
$estado = $_POST['estado'];

try {
    $conn->beginTransaction();
    
    // Insertar en la tabla de asignación correspondiente
    if ($tipoCliente === 'natural') {
        $query = "INSERT INTO asignacion_carga_cliente (idCotizacion, observaciones, estado) 
                  VALUES (:idCotizacion, :observaciones, :estado)";
        
        // Actualizar estado de la cotización a "Aceptada"
        $update = "UPDATE cotizaciones_clientes SET estado = 'Aceptada' WHERE idCotizacion = :idCotizacion";
        
        // Obtener el idSolicitud para actualizar la tabla solicitudes_clientes
        $getSolicitud = "SELECT idSolicitud FROM cotizaciones_clientes WHERE idCotizacion = :idCotizacion";
        
        // Actualizar estado de la solicitud a "Entregado"
        $updateSolicitud = "UPDATE solicitudes_clientes SET estado = 'Entregado' WHERE idSolicitud = :idSolicitud";
    } else {
        $query = "INSERT INTO asignacion_carga_empresa (idCotizacionEmpresa, observaciones, estado) 
                  VALUES (:idCotizacion, :observaciones, :estado)";
        
        // Actualizar estado de la cotización a "Aceptada"
        $update = "UPDATE cotizaciones_empresas SET estado = 'Aceptada' WHERE idCotizacionEmpresa = :idCotizacion";
        
        // Obtener el idSolicitudempresa para actualizar la tabla solicitud_empresa
        $getSolicitud = "SELECT idSolicitudempresa FROM cotizaciones_empresas WHERE idCotizacionEmpresa = :idCotizacion";
        
        // Actualizar estado de la solicitud a "entregado"
        $updateSolicitud = "UPDATE solicitud_empresa SET estado = 'entregado' WHERE idSolicitudempresa = :idSolicitud";
    }
    
    // Insertar asignación
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idCotizacion', $idCotizacion);
    $stmt->bindParam(':observaciones', $observaciones);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();
    
    // Actualizar estado de la cotización
    $stmtUpdate = $conn->prepare($update);
    $stmtUpdate->bindParam(':idCotizacion', $idCotizacion);
    $stmtUpdate->execute();
    
    // Obtener el idSolicitud correspondiente
    $stmtSolicitud = $conn->prepare($getSolicitud);
    $stmtSolicitud->bindParam(':idCotizacion', $idCotizacion);
    $stmtSolicitud->execute();
    $solicitud = $stmtSolicitud->fetch(PDO::FETCH_ASSOC);
    $idSolicitud = ($tipoCliente === 'natural') ? $solicitud['idSolicitud'] : $solicitud['idSolicitudempresa'];
    
    // Actualizar estado de la solicitud
    $stmtUpdateSolicitud = $conn->prepare($updateSolicitud);
    $stmtUpdateSolicitud->bindParam(':idSolicitud', $idSolicitud);
    $stmtUpdateSolicitud->execute();
    
    $conn->commit();
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>