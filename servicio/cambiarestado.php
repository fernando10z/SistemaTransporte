<?php
require '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Obtener estado actual
        $stmt = $conn->prepare("SELECT Estado FROM servicios WHERE idServicio = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $servicio = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($servicio) {
            $nuevoEstado = $servicio['Estado'] === 'Activo' ? 'Inactivo' : 'Activo';

            // Actualizar estado
            $update = $conn->prepare("UPDATE servicios SET Estado = :nuevoEstado WHERE idServicio = :id");
            $update->bindParam(':nuevoEstado', $nuevoEstado);
            $update->bindParam(':id', $id, PDO::PARAM_INT);
            $update->execute();

            echo json_encode(['status' => 'success', 'nuevoEstado' => $nuevoEstado]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Servicio no encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no recibido']);
}
?>
