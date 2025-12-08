<?php
require '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener estado actual
    $sql = "SELECT estado FROM sanciones_conductores WHERE idSancion = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $sancion = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($sancion) {
        // Cambiar el estado en orden: Pendiente -> En Proceso -> Resuelta -> Pendiente
        $estadoActual = $sancion['estado'];
        $nuevoEstado = match($estadoActual) {
            'Pendiente' => 'En Proceso',
            'En Proceso' => 'Resuelta',
            default => 'Pendiente',
        };

        $update = "UPDATE sanciones_conductores SET estado = :nuevoEstado WHERE idSancion = :id";
        $stmt = $conn->prepare($update);
        if ($stmt->execute([':nuevoEstado' => $nuevoEstado, ':id' => $id])) {
            echo json_encode(['success' => true, 'message' => 'Estado actualizado a "' . $nuevoEstado . '"']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar estado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Sanción no encontrada']);
    }
}
?>
