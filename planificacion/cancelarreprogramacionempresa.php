<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (empty($_POST['idReprogramacion']) || empty($_POST['idPlanificacion'])) {
        throw new Exception('Datos incompletos');
    }

    $conn->beginTransaction();

    // 1. Actualizar estado de la reprogramación
    $sqlUpdateRepro = "UPDATE reprogramacionesEmpresa 
                      SET estado = 'Cancelado'
                      WHERE idReprogramacionempresa = :id";
    $stmtUpdateRepro = $conn->prepare($sqlUpdateRepro);
    $stmtUpdateRepro->execute([':id' => $_POST['idReprogramacion']]);

    // 2. Actualizar planificación a estado Planificado
    $sqlUpdatePlan = "UPDATE planificacion_ruta_empresa
                     SET estado = 'Planificado'
                     WHERE idPlanificacionempresa = :id";
    $stmtUpdatePlan = $conn->prepare($sqlUpdatePlan);
    $stmtUpdatePlan->execute([':id' => $_POST['idPlanificacion']]);

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Reprogramación cancelada correctamente'
    ]);
    
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>