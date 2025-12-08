<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $requiredFields = ['idPlanificacion', 'motivo', 'fechaReprogramada', 'horaReprogramada'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("El campo $field es obligatorio");
        }
    }

    $conn->beginTransaction();

    // 1. Anular reprogramación anterior activa
    $sqlAnular = "UPDATE reprogramacionescliente 
                 SET estado = 'Anulado'
                 WHERE idPlanificacion = :id AND estado IN ('Activo', 'Pendiente')";
    $stmtAnular = $conn->prepare($sqlAnular);
    $stmtAnular->execute([':id' => $_POST['idPlanificacion']]);

    // 2. Insertar nueva reprogramación
    $sqlInsert = "INSERT INTO reprogramacionescliente (
        idPlanificacion, Planificacionoriginal, motivo, 
        fechaReprogramada, horaReprogramada, estado
    ) VALUES (
        :idPlanificacion, :planificacionOriginal, :motivo,
        :fechaReprogramada, :horaReprogramada, 'Activo'
    )";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->execute([
        ':idPlanificacion' => $_POST['idPlanificacion'],
        ':planificacionOriginal' => $_POST['planificacionOriginal'],
        ':motivo' => $_POST['motivo'],
        ':fechaReprogramada' => $_POST['fechaReprogramada'],
        ':horaReprogramada' => $_POST['horaReprogramada']
    ]);

    // 3. Actualizar planificación
    $sqlUpdate = "UPDATE planificacion_ruta 
                 SET estado = 'Reprogramado',
                     fechaPlanificada = :fecha, 
                     horaPlanificada = :hora
                 WHERE idPlanificacion = :id";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':fecha' => $_POST['fechaReprogramada'],
        ':hora' => $_POST['horaReprogramada'],
        ':id' => $_POST['idPlanificacion']
    ]);

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Reprogramación guardada correctamente'
    ]);
    
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>