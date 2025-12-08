<?php
header('Content-Type: application/json; charset=utf-8');
include('../conexion/conexion.php');

// Obtener datos del formulario
$idAsistencia = $_POST['idAsistencia'] ?? null;
$idConductor = $_POST['idConductor'] ?? null;
$dia = $_POST['dia'] ?? '';
$hora_entrada = $_POST['hora_entrada'] ?? '';
$hora_salida = $_POST['hora_salida'] ?? '';
$horas_conducidas = $_POST['horas_conducidas'] ?? 0;
$observaciones = $_POST['observaciones'] ?? '';

// Validar datos requeridos
if (!$idConductor || !$dia || !$hora_entrada || !$horas_conducidas) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Datos incompletos'
    ]);
    exit;
}

try {
    // Verificar si el conductor existe
    $stmt = $conn->prepare("SELECT idConductor FROM conductores WHERE idConductor = ?");
    $stmt->execute([$idConductor]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'error' => 'Conductor no encontrado'
        ]);
        exit;
    }

    if (empty($idAsistencia)) {
        // Verificar si ya existe asistencia en ese día
        $stmtCheck = $conn->prepare("SELECT idAsistencia FROM asistencia_conductores WHERE idConductor = ? AND dia = ?");
        $stmtCheck->execute([$idConductor, $dia]);
        $asistenciaExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($asistenciaExistente) {
            http_response_code(409);
            echo json_encode([
                'success' => false,
                'error' => 'Ya existe un registro de asistencia para este conductor en el día indicado.'
            ]);
            exit;
        }

        // Insertar asistencia
        $stmtInsert = $conn->prepare("INSERT INTO asistencia_conductores 
            (idConductor, dia, hora_entrada, hora_salida, horas_conducidas, observaciones, estado)
            VALUES (?, ?, ?, ?, ?, ?, 'Ingreso')");
        $stmtInsert->execute([
            $idConductor,
            $dia,
            $hora_entrada,
            $hora_salida,
            $horas_conducidas,
            $observaciones
        ]);

    } else {
        // Actualizar asistencia existente
        $stmtUpdate = $conn->prepare("UPDATE asistencia_conductores 
            SET idConductor = ?, dia = ?, hora_entrada = ?, hora_salida = ?, 
                horas_conducidas = ?, observaciones = ?
            WHERE idAsistencia = ?");
        $stmtUpdate->execute([
            $idConductor,
            $dia,
            $hora_entrada,
            $hora_salida,
            $horas_conducidas,
            $observaciones,
            $idAsistencia
        ]);
    }

    echo json_encode([
        'success' => true
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>
