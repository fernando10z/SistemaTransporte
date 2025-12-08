<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    
    $idPlanificacionEmpresa = $data['idPlanificacionEmpresa'] ?? null;
    $tipoEvento = $data['tipoEvento'] ?? '';
    $descripcion = $data['descripcion'] ?? '';
    $latitud = $data['latitud'] ?? '';
    $longitud = $data['longitud'] ?? '';
    $fechaEvento = $data['fechaEvento'] ?? date('Y-m-d H:i:s');

    if (!$idPlanificacionEmpresa || !$tipoEvento) {
        throw new Exception('Faltan datos requeridos');
    }

    $conn->beginTransaction();
    
    // Insertar evento
    $query = "INSERT INTO eventos_ruta_empresa 
              (idPlanificacionempresa, descripcion, latitud, longitud, fechaEvento, tipoEvento) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idPlanificacionEmpresa, $descripcion, $latitud, $longitud, $fechaEvento, $tipoEvento]);
    
    // Obtener idAsignacion relacionado con esta planificación
  
                         $queryAsignacion = "SELECT a.idAsignacionEmpresa, a.idCotizacionEmpresa 
                    FROM planificacion_ruta_empresa p
                    JOIN asignacion_carga_empresa a ON p.idAsignacionEmpresa = a.idAsignacionEmpresa
                    WHERE p.idPlanificacionempresa = ?";
    $stmtAsignacion = $conn->prepare($queryAsignacion);
    $stmtAsignacion->execute([$idPlanificacionEmpresa]);
    $asignacion = $stmtAsignacion->fetch(PDO::FETCH_ASSOC);
    
    if ($asignacion) {
        $idAsignacionEmpresa = $asignacion['idAsignacionEmpresa'];
        
        // Actualizar estados según el tipo de evento
        if ($tipoEvento === 'Completado') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta_empresa SET estado = 'Completado' WHERE idPlanificacionempresa = ?";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([$idPlanificacionEmpresa]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_empresa SET estado = 'Entregado' WHERE idAsignacionEmpresa = ?";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([$idAsignacionEmpresa]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioempresa SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() WHERE idAsignacionEmpresa = ?";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([$idAsignacionEmpresa]);
            
        } elseif ($tipoEvento === 'Incidente') {
            // Actualizar planificación
            $updatePlanificacion = "UPDATE planificacion_ruta_empresa SET estado = 'Cancelado' WHERE idPlanificacionempresa = ?";
            $stmtPlanificacion = $conn->prepare($updatePlanificacion);
            $stmtPlanificacion->execute([$idPlanificacionEmpresa]);
            
            // Actualizar asignación
            $updateAsignacion = "UPDATE asignacion_carga_empresa SET estado = 'Pendiente' WHERE idAsignacionEmpresa = ?";
            $stmtAsignacion = $conn->prepare($updateAsignacion);
            $stmtAsignacion->execute([$idAsignacionEmpresa]);
            
            // Actualizar seguimiento
            $updateSeguimiento = "UPDATE seguimiento_envioempresa SET estadoEnvio = 'Cancelado', ultimaActualizacion = NOW() WHERE idAsignacionEmpresa = ?";
            $stmtSeguimiento = $conn->prepare($updateSeguimiento);
            $stmtSeguimiento->execute([$idAsignacionEmpresa]);
        }
    }
    
    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Evento registrado correctamente';
} catch(PDOException $e) {
    $conn->rollBack();
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>