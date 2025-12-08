<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idUsuario'];

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE idUsuario = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Usuario eliminado correctamente']);
    } else {
        echo json_encode(['message' => 'Error al eliminar usuario']);
    }
}
