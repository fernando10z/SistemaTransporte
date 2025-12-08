<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (empty($_POST['idReprogramacion'])) {
        throw new Exception('ID de reprogramación no recibido');
    }

    // Verificar que el registro esté anulado
    $sqlCheck = "SELECT estado FROM reprogramacionescliente 
                WHERE idReprogramacion = :id";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute([':id' => $_POST['idReprogramacion']]);
    $registro = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if (!$registro) {
        throw new Exception('Registro no encontrado');
    }

    if ($registro['estado'] !== 'Anulado') {
        throw new Exception('Solo se pueden eliminar reprogramaciones anuladas');
    }

    // Eliminar registro
    $sqlDelete = "DELETE FROM reprogramacionescliente 
                 WHERE idReprogramacion = :id";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->execute([':id' => $_POST['idReprogramacion']]);

    echo json_encode([
        'success' => true,
        'message' => 'Registro eliminado correctamente'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>