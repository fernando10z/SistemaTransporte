<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $data = $_POST;
    
    $idSeguimientoEmpresa = $data['idSeguimientoEmpresa'];
    $tipoSeguimiento = $data['tipoSeguimiento'];
    $latitud = $data['latitud'];
    $longitud = $data['longitud'];
    $observaciones = $data['observaciones'];
    $fechaEvento = $data['fechaEvento'];

    // Insertar evento
    $conn->beginTransaction();
    
    $query = "INSERT INTO eventos_envio_empresa 
              (idSeguimientoEmpresa, tipoSeguimiento, latitud, longitud, observaciones, fechaEvento) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idSeguimientoEmpresa, $tipoSeguimiento, $latitud, $longitud, $observaciones, $fechaEvento]);

    // Si el estado es "Entregado", actualizar seguimiento y asignación
    if($tipoSeguimiento == 'Entregado') {
        // Actualizar seguimiento
        $query = "UPDATE seguimiento_envioempresa 
                  SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() 
                  WHERE idSeguimientoEmpresa = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$idSeguimientoEmpresa]);
        
        // Actualizar asignación
        $query = "UPDATE asignacion_carga_empresa ae
                  JOIN seguimiento_envioempresa se ON ae.idAsignacionEmpresa = se.idAsignacionEmpresa
                  SET ae.estado = 'Entregado'
                  WHERE se.idSeguimientoEmpresa = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$idSeguimientoEmpresa]);
    }

    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Evento guardado correctamente']);
} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al guardar evento: ' . $e->getMessage()]);
}