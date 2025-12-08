<?php
require '../conexion/conexion.php';           // tu archivo de conexión (el que mostraste)

if (!isset($_POST['id'])) {
    echo 'Parámetro faltante';
    exit;
}

$id = intval($_POST['id']);

try {
    $sql = "DELETE FROM asistencia_conductores WHERE idAsistencia = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo $stmt->rowCount() ? 'ok' : 'No existe';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
