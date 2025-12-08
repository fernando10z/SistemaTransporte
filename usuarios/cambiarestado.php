<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idUsuario'];
    $nuevoEstado = $_POST['nuevoEstado'];

    $stmt = $conn->prepare("UPDATE usuarios SET estado = :estado WHERE idUsuario = :id");
    $stmt->bindParam(':estado', $nuevoEstado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Estado actualizado correctamente']);
    } else {
        echo json_encode(['message' => 'Error al actualizar estado']);
    }
}
