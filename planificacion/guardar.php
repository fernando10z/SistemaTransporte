<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

// Recibir datos del formulario
$data = json_decode(file_get_contents('php://input'), true) ?: $_POST;

try {
    // Validar datos requeridos
    if (empty($data['tipoCliente'])) {
        throw new Exception('No se especificó el tipo de cliente');
    }

    // Determinar en qué tabla guardar
    $tabla = ($data['tipoCliente'] === 'empresa') ? 'planificacion_ruta_empresa' : 'planificacion_ruta';
    $idAsignacionField = ($data['tipoCliente'] === 'empresa') ? 'idAsignacionEmpresa' : 'idAsignacion';

    // Validar campos obligatorios
    $camposRequeridos = [
        $idAsignacionField => 'Asignación',
        'idRuta' => 'Ruta',
        'idVehiculo' => 'Vehículo',
        'idConductor' => 'Conductor',
        'fechaPlanificada' => 'Fecha planificada',
        'horaPlanificada' => 'Hora planificada',
        'estado' => 'Estado'
    ];

    foreach ($camposRequeridos as $campo => $nombre) {
        if (empty($data[$campo])) {
            throw new Exception("El campo {$nombre} es requerido");
        }
    }

    // Validar formato de fecha y hora
    if (!DateTime::createFromFormat('Y-m-d', $data['fechaPlanificada'])) {
        throw new Exception('Formato de fecha inválido (YYYY-MM-DD)');
    }

    if (!DateTime::createFromFormat('H:i', $data['horaPlanificada'])) {
        throw new Exception('Formato de hora inválido (HH:MM)');
    }

    // Validar que la asignación exista
    $tablaAsignacion = ($data['tipoCliente'] === 'empresa') ? 'asignacion_carga_empresa' : 'asignacion_carga_cliente';
    $stmt = $conn->prepare("SELECT COUNT(*) FROM {$tablaAsignacion} WHERE {$idAsignacionField} = ?");
    $stmt->execute([$data[$idAsignacionField]]);
    if ($stmt->fetchColumn() == 0) {
        throw new Exception('La asignación no existe');
    }

    // Validar que el vehículo exista y esté disponible
    $stmt = $conn->prepare("SELECT estado FROM vehiculos WHERE idVehiculo = ?");
    $stmt->execute([$data['idVehiculo']]);
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

   

    // Validar que el conductor exista y esté activo
    $stmt = $conn->prepare("SELECT estado FROM conductores WHERE idConductor = ?");
    $stmt->execute([$data['idConductor']]);
    $conductor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$conductor) {
        throw new Exception('El conductor no existe');
    }
    if ($conductor['estado'] !== 'Activo') {
        throw new Exception('El conductor no está activo');
    }

    // Validar que la ruta exista y esté activa
    $stmt = $conn->prepare("SELECT estado FROM rutas WHERE idRuta = ?");
    $stmt->execute([$data['idRuta']]);
    $ruta = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ruta) {
        throw new Exception('La ruta no existe');
    }
    if ($ruta['estado'] !== 'Activado') {
        throw new Exception('La ruta no está activada');
    }

    // Iniciar transacción
    $conn->beginTransaction();

    try {
        // Insertar la planificación
        $sql = "INSERT INTO {$tabla} (
            {$idAsignacionField},
            idRuta,
            idVehiculo,
            idConductor,
            fechaPlanificada,
            horaPlanificada,
            observaciones,
            estado,
            fecharegistro
        ) VALUES (
            :idAsignacion,
            :idRuta,
            :idVehiculo,
            :idConductor,
            :fechaPlanificada,
            :horaPlanificada,
            :observaciones,
            :estado,
            NOW()
        )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idAsignacion', $data[$idAsignacionField]);
        $stmt->bindParam(':idRuta', $data['idRuta']);
        $stmt->bindParam(':idVehiculo', $data['idVehiculo']);
        $stmt->bindParam(':idConductor', $data['idConductor']);
        $stmt->bindParam(':fechaPlanificada', $data['fechaPlanificada']);
        $stmt->bindParam(':horaPlanificada', $data['horaPlanificada']);
        $stmt->bindParam(':observaciones', $data['observaciones']);
        $stmt->bindParam(':estado', $data['estado']);
        
        if (!$stmt->execute()) {
            throw new Exception('Error al guardar la planificación');
        }

        // Actualizar estado de la asignación a "En tránsito"
        $updateSql = "UPDATE {$tablaAsignacion} SET estado = 'En tránsito' WHERE {$idAsignacionField} = :idAsignacion";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':idAsignacion', $data[$idAsignacionField]);
        if (!$updateStmt->execute()) {
            throw new Exception('Error al actualizar el estado de la asignación');
        }

        // Actualizar estado del vehículo a "Ocupado"
        $updateSql = "UPDATE vehiculos SET estado = 'Ocupado' WHERE idVehiculo = :idVehiculo";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':idVehiculo', $data['idVehiculo']);
        if (!$updateStmt->execute()) {
            throw new Exception('Error al actualizar el estado del vehículo');
        }

          // Actualizar estado del vehículo a "Inactivo"
        $updateSql = "UPDATE conductores SET estado = 'Inactivo' WHERE idConductor = :idConductor";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':idConductor', $data['idConductor']);
        if (!$updateStmt->execute()) {
            throw new Exception('Error al actualizar el estado del vehículo');
        }

        // Confirmar transacción
        $conn->commit();

        // Respuesta exitosa
        echo json_encode([
            'success' => true,
            'message' => 'Planificación registrada correctamente',
            'idPlanificacion' => $conn->lastInsertId()
        ]);

    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conn->rollBack();
        throw $e;
    }

} catch (Exception $e) {
    // Manejar errores
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => $e->getCode()
    ]);
}
?>