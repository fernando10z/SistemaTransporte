<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM transacciones_financieras WHERE idtransaccion = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "ok";
}
?>
