<?php
include('../conexion/conexion.php');

if (isset($_POST['id'])) {
    $idTarifa = $_POST['id'];

    try {
        $sql = "DELETE FROM tarifas WHERE idTarifa = :idTarifa";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idTarifa', $idTarifa);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Tarifa eliminada correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no recibido.']);
}
?>
