<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $data = $_POST;
    
    $idEvento = $data['idEvento'] ?? null;
    $tipoEnvio = $data['tipoEnvio'] ?? null;
    
    if(!$idEvento || !$tipoEnvio) {
        throw new Exception('Faltan parámetros requeridos');
    }
    
    $conn->beginTransaction();
    
    if($tipoEnvio === 'cliente') {
        $query = "UPDATE eventos_envio_clientes SET
                    tipoSeguimiento = ?,
                    latitud = ?,
                    longitud = ?,
                    observaciones = ?,
                    fechaEvento = ?
                  WHERE idEvento = ?";
    } else {
        $query = "UPDATE eventos_envio_empresa SET
                    tipoSeguimiento = ?,
                    latitud = ?,
                    longitud = ?,
                    observaciones = ?,
                    fechaEvento = ?
                  WHERE idEventoEnvio = ?";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute([
        $data['tipoSeguimiento'],
        $data['latitud'],
        $data['longitud'],
        $data['observaciones'],
        $data['fechaEvento'],
        $idEvento
    ]);
    
    // Si el estado es "Entregado", actualizar seguimiento y asignación
    if($data['tipoSeguimiento'] === 'Entregado') {
        if($tipoEnvio === 'cliente') {
            // Actualizar seguimiento cliente
            $query = "UPDATE seguimiento_envioclientes 
                      SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() 
                      WHERE idSeguimiento = ?";
            
            // Actualizar asignación cliente
            $query2 = "UPDATE asignacion_carga_cliente ac
                      JOIN seguimiento_envioclientes sc ON ac.idAsignacion = sc.idAsignacion
                      SET ac.estado = 'Entregado'
                      WHERE sc.idSeguimiento = ?";
        } else {
            // Actualizar seguimiento empresa
            $query = "UPDATE seguimiento_envioempresa 
                      SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() 
                      WHERE idSeguimientoEmpresa = ?";
            
            // Actualizar asignación empresa
            $query2 = "UPDATE asignacion_carga_empresa ae
                      JOIN seguimiento_envioempresa se ON ae.idAsignacionEmpresa = se.idAsignacionEmpresa
                      SET ae.estado = 'Entregado'
                      WHERE se.idSeguimientoEmpresa = ?";
        }
        
        $stmt = $conn->prepare($query);
        $stmt->execute([$data['idSeguimiento']]);
        
        $stmt = $conn->prepare($query2);
        $stmt->execute([$data['idSeguimiento']]);
    }
    
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Evento actualizado correctamente']);
} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}