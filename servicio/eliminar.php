<?php
require '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM servicios WHERE idServicio = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Servicio eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el servicio']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no recibido']);
}
?>
