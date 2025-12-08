<?php
include('../conexion/conexion.php'); // Incluye tu archivo de conexión

if (isset($_POST['id'])) {
    $idZona = $_POST['id'];

    try {
        // Obtener el estado actual de la zona
        $sql = "SELECT Estado FROM zonas_cobertura WHERE idZona = :idZona";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idZona', $idZona);
        $stmt->execute();
        $zona = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($zona) {
            // Cambiar el estado a 'Activo' o 'Inactivo' dependiendo del estado actual
            $nuevoEstado = ($zona['Estado'] == 'Activo') ? 'Inactivo' : 'Activo';

            $updateSql = "UPDATE zonas_cobertura SET Estado = :nuevoEstado WHERE idZona = :idZona";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':nuevoEstado', $nuevoEstado);
            $updateStmt->bindParam(':idZona', $idZona);
            $updateStmt->execute();

            // Respuesta exitosa con el nuevo estado
            echo json_encode(['status' => 'success', 'nuevoEstado' => $nuevoEstado, 'message' => 'Estado actualizado correctamente.']);
        } else {
            // Zona no encontrada
            echo json_encode(['status' => 'error', 'message' => 'Zona no encontrada.']);
        }
    } catch (Exception $e) {
        // Respuesta con error
        echo json_encode(['status' => 'error', 'message' => 'Error al cambiar el estado: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado.']);
}
?>
