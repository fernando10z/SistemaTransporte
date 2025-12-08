<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    
    $idEvento = $data['idEvento'] ?? null;
    $idPlanificacion = $data['idPlanificacion'] ?? null;
    $tipoEvento = $data['tipoEvento'] ?? '';
    $descripcion = $data['descripcion'] ?? '';
    $latitud = $data['latitud'] ?? '';
    $longitud = $data['longitud'] ?? '';
    $fechaEvento = $data['fechaEvento'] ?? date('Y-m-d H:i:s');

    if (!$idEvento || !$idPlanificacion || !$tipoEvento) {
        throw new Exception('Faltan datos requeridos');
    }

    $conn->beginTransaction();
    
    // Actualizar evento
    $query = "UPDATE eventos_ruta SET 
              idPlanificacion = ?,
              descripcion = ?,
              latitud = ?,
              longitud = ?,
              fechaEvento = ?,
              tipoEvento = ?
              WHERE idEvento = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idPlanificacion, $descripcion, $latitud, $longitud, $fechaEvento, $tipoEvento, $idEvento]);
    
    // Obtener idAsignacion relacionado con esta planificación
    $queryAsignacion = "SELECT a.idAsignacion, a.idCotizacion 
                    FROM planificacion_ruta p
                    JOIN asignacion_carga_cliente a ON p.idAsignacion = a.idAsignacion
                    WHERE p.idPlanificacion = ?";
                     
    $stmtAsignacion = $conn->prepare($queryAsignacion);
    $stmtAsignacion->execute([$idPlanificacion]);
    $asignacion = $stmtAsignacion->fetch(PDO::FETCH_ASSOC);
    
    if ($asignacion) {
        $idAsignacion = $asignacion['idAsignacion'];
        
        // Actualizar estados según el tipo de evento
        if ($tipoEvento === 'Completado') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta SET estado = 'Completado' WHERE idPlanificacion = ?";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([$idPlanificacion]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_cliente SET estado = 'Entregado' WHERE idAsignacion = ?";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([$idAsignacion]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioclientes SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() WHERE idAsignacion = ?";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([$idAsignacion]);
            
        } elseif ($tipoEvento === 'Incidente') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta SET estado = 'Cancelado' WHERE idPlanificacion = ?";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([$idPlanificacion]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_cliente SET estado = 'Cancelado' WHERE idAsignacion = ?";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([$idAsignacion]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioclientes SET estadoEnvio = 'Cancelado', ultimaActualizacion = NOW() WHERE idAsignacion = ?";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([$idAsignacion]);
        }
    }
    
    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Evento actualizado correctamente';
} catch(PDOException $e) {
    $conn->rollBack();
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>