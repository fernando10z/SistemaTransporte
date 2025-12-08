<?php
require '../conexion/conexion.php';
header('Content-Type: application/json');

if (!empty($_POST['idContrato'])) {
    $id = $_POST['idContrato'];

    try {
        // Empezamos con el borrado de los detalles para contratos naturales
        $stmt = $conn->prepare("DELETE FROM detalle_contrato_natural WHERE idContrato = :id");
        $stmt->execute([':id' => $id]);

        // Ahora, intentamos borrar de contratos_naturales
        $stmt = $conn->prepare("DELETE FROM contratos_naturales WHERE idContrato = :id");
        $stmt->execute([':id' => $id]);

        // Si no existía en contratos_naturales, intentamos en contratos_empresas
        if ($stmt->rowCount() === 0) {
            // Borramos los detalles para contratos de empresas
            $stmt = $conn->prepare("DELETE FROM detalle_contrato_empresa WHERE idContratoempresa = :id");
            $stmt->execute([':id' => $id]);

            // Finalmente, eliminamos el contrato de la tabla contratos_empresas
            $stmt = $conn->prepare("DELETE FROM contratos_empresas WHERE idContratoempresa = :id");
            $stmt->execute([':id' => $id]);
        }

        echo json_encode(['success' => true, 'message' => 'Contrato y detalles eliminados correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
}
