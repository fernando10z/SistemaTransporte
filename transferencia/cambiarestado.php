<?php
require '..//conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nuevoEstado = $_POST['estado'];

    $sql = "UPDATE transacciones_financieras SET estado = :estado WHERE idtransaccion = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':estado', $nuevoEstado);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "ok";
}
?>
