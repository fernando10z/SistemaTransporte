<?php
include('../conexion/conexion.php'); // Incluye tu archivo de conexión

if (isset($_POST['id'])) {
    $idZona = $_POST['id'];

    try {
        // Preparar y ejecutar la eliminación
        $sql = "DELETE FROM zonas_cobertura WHERE idZona = :idZona";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idZona', $idZona);
        $stmt->execute();

        // Respuesta exitosa
        echo json_encode(['status' => 'success', 'message' => 'Zona eliminada correctamente.']);
    } catch (Exception $e) {
        // Respuesta con error
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la zona: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado.']);
}
?>
