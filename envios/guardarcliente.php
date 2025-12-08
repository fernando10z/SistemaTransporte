<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $data = $_POST;
    
    $idSeguimiento = $data['idSeguimiento'];
    $tipoSeguimiento = $data['tipoSeguimiento'];
    $latitud = $data['latitud'];
    $longitud = $data['longitud'];
    $observaciones = $data['observaciones'];
    $fechaEvento = $data['fechaEvento'];

    // Insertar evento
    $conn->beginTransaction();
    
    $query = "INSERT INTO eventos_envio_clientes 
              (idSeguimiento, tipoSeguimiento, latitud, longitud, observaciones, fechaEvento) 
              VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idSeguimiento, $tipoSeguimiento, $latitud, $longitud, $observaciones, $fechaEvento]);

    // Si el estado es "Entregado", actualizar seguimiento y asignación
    if($tipoSeguimiento == 'Entregado') {
        // Actualizar seguimiento
        $query = "UPDATE seguimiento_envioclientes 
                  SET estadoEnvio = 'Entregado', ultimaActualizacion = NOW() 
                  WHERE idSeguimiento = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$idSeguimiento]);
        
        // Actualizar asignación
        $query = "UPDATE asignacion_carga_cliente ac
                  JOIN seguimiento_envioclientes sc ON ac.idAsignacion = sc.idAsignacion
                  SET ac.estado = 'Entregado'
                  WHERE sc.idSeguimiento = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$idSeguimiento]);
    }

    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Evento guardado correctamente']);
} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al guardar evento: ' . $e->getMessage()]);
}