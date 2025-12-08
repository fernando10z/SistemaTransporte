<?php
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMovimiento = $_POST['id']; // <== aquí estaba el problema

    $sql = "DELETE FROM movimiento_producto WHERE idMovimiento = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $idMovimiento);

    if ($stmt->execute()) {
        echo "Movimiento eliminado correctamente.";
    } else {
        echo "Error al eliminar el movimiento.";
    }
}
?>
