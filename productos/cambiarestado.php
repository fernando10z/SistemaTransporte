<?php
include '../conexion/conexion.php'; // Asegúrate de que la conexión sea válida

if (isset($_POST['idProducto'], $_POST['nuevoEstado'])) {
    $id = $_POST['idProducto'];
    $estado = $_POST['nuevoEstado'];

    $stmt = $conn->prepare("UPDATE producto SET status = :estado WHERE idProducto = :id");
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "ok";
} else {
    echo "error";
}
