<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMovimiento = $_POST['idMovimiento'];
    $motivo = $_POST['motivo'];

    $sql = "UPDATE movimiento_producto SET motivo = :motivo WHERE idMovimiento = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':motivo', $motivo);
    $stmt->bindParam(':id', $idMovimiento);

    if ($stmt->execute()) {
        echo "Motivo actualizado correctamente.";
    } else {
        echo "Error al actualizar el motivo.";
    }
}
?>
