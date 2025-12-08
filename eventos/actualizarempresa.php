<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Obtener datos de entrada
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data === null) {
        $data = $_POST;
    }
    
    // Buscar el ID de planificación con diferentes nombres posibles
    $idPlanificacionEmpresa = $data['idPlanificacionEmpresa'] ?? 
                             $data['idPlanificacionempresa'] ?? 
                             $data['id_planificacion'] ?? 
                             $data['idPlanificacion'] ?? null;
    
    $idEvento = $data['idEvento'] ?? null;
    $tipoEvento = $data['tipoEvento'] ?? '';
    $descripcion = $data['descripcion'] ?? '';
    $latitud = $data['latitud'] ?? '';
    $longitud = $data['longitud'] ?? '';
    $fechaEvento = $data['fechaEvento'] ?? date('Y-m-d H:i:s');

    // Validación robusta
    if (empty($idEvento) || empty($idPlanificacionEmpresa) || empty($tipoEvento)) {
        throw new Exception('Faltan datos requeridos');
    }

    $conn->beginTransaction();
    
    // Actualizar evento
    $query = "UPDATE eventos_ruta_empresa SET 
              idPlanificacionempresa = :idPlanificacion,
              descripcion = :descripcion,
              latitud = :latitud,
              longitud = :longitud,
              fechaEvento = :fechaEvento,
              tipoEvento = :tipoEvento
              WHERE idEvento = :idEvento";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([
        ':idPlanificacion' => $idPlanificacionEmpresa,
        ':descripcion' => $descripcion,
        ':latitud' => $latitud,
        ':longitud' => $longitud,
        ':fechaEvento' => $fechaEvento,
        ':tipoEvento' => $tipoEvento,
        ':idEvento' => $idEvento
    ]);
    
    // Obtener idAsignacion relacionado con esta planificación
     $queryAsignacion = "SELECT a.idAsignacionEmpresa, a.idCotizacionEmpresa 
                    FROM planificacion_ruta_empresa p
                    JOIN asignacion_carga_empresa a  ON p.idAsignacionEmpresa = a.idAsignacionEmpresa
                    WHERE p.idPlanificacionempresa = ?";
                    
    $stmtAsignacion = $conn->prepare($queryAsignacion);
    $stmtAsignacion->execute([$idPlanificacionEmpresa]);
    $asignacion = $stmtAsignacion->fetch(PDO::FETCH_ASSOC);
    
    if ($asignacion) {
        $idAsignacionEmpresa = $asignacion['idAsignacionEmpresa'];
        
        // Actualizar estados según el tipo de evento
        if ($tipoEvento === 'Completado') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta_empresa SET estado = 'Completado' 
                                  WHERE idPlanificacionempresa = :idPlanificacion";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([':idPlanificacion' => $idPlanificacionEmpresa]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_empresa SET estado = 'Entregado' 
                               WHERE idAsignacionEmpresa = :idAsignacion";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([':idAsignacion' => $idAsignacionEmpresa]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioempresa SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() 
                                WHERE idAsignacionEmpresa = :idAsignacion";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([':idAsignacion' => $idAsignacionEmpresa]);
            
        } elseif ($tipoEvento === 'Incidente') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta_empresa SET estado = 'Cancelado' 
                                  WHERE idPlanificacionempresa = :idPlanificacion";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([':idPlanificacion' => $idPlanificacionEmpresa]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_empresa SET estado = 'Cancelado' 
                               WHERE idAsignacionEmpresa = :idAsignacion";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([':idAsignacion' => $idAsignacionEmpresa]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioempresa SET estadoEnvio = 'Cancelado', ultimaActualizacion = NOW() 
                                WHERE idAsignacionEmpresa = :idAsignacion";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([':idAsignacion' => $idAsignacionEmpresa]);
        }
    }
    
    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Evento actualizado correctamente';
} catch(PDOException $e) {
    $conn->rollBack();
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
    error_log("PDOException: " . $e->getMessage());
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
    error_log("Exception: " . $e->getMessage());
}

echo json_encode($response);
?>