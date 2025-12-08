<?php
require '../conexion/conexion.php';
header('Content-Type: application/json');

if (!empty($_POST['idContrato']) && !empty($_POST['nuevoEstado'])) {
    $id = $_POST['idContrato'];
    $nuevo = $_POST['nuevoEstado'];

    try {
        // Verificar si el nuevo estado es "Completado"
        if ($nuevo === 'Completado') {
            echo json_encode(['success' => false, 'message' => 'No se puede cambiar directamente a "Completado".']);
            exit;
        }

        // Intentar actualizar en contratos_naturales
        $stmt = $conn->prepare("UPDATE contratos_naturales SET estado = :nuevo WHERE idContrato = :id");
        $stmt->execute([':nuevo' => $nuevo, ':id' => $id]);

        // Si no afectó ninguna fila, lo hacemos en contratos_empresas
        if ($stmt->rowCount() === 0) {
            $stmt = $conn->prepare("UPDATE contratos_empresas SET estado = :nuevo WHERE idContratoempresa = :id");
            $stmt->execute([':nuevo' => $nuevo, ':id' => $id]);
        }

        // Verificar si se actualizó algún registro
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => "Estado actualizado a «{$nuevo}»."]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró el contrato especificado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetros inválidos.']);
}
?>