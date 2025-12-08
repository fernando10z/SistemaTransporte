<?php
include('../conexion/conexion.php');

if (isset($_POST['id'])) {
    $idTarifa = $_POST['id'];

    try {
        $sql = "SELECT Estado FROM tarifas WHERE idTarifa = :idTarifa";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idTarifa', $idTarifa);
        $stmt->execute();
        $tarifa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tarifa) {
            $nuevoEstado = ($tarifa['Estado'] === 'Activo') ? 'Inactivo' : 'Activo';

            $updateSql = "UPDATE tarifas SET Estado = :nuevoEstado WHERE idTarifa = :idTarifa";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':nuevoEstado', $nuevoEstado);
            $updateStmt->bindParam(':idTarifa', $idTarifa);
            $updateStmt->execute();

            echo json_encode(['status' => 'success', 'nuevoEstado' => $nuevoEstado, 'message' => 'Estado actualizado.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tarifa no encontrada.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no recibido.']);
}
?>
