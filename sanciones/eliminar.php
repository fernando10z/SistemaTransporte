<?php
require '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM sanciones_conductores WHERE idSancion = :id";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([':id' => $id])) {
        echo json_encode(['success' => true, 'message' => 'Sanción eliminada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la sanción']);
    }
}
?>
