<?php
require '../conexion/conexion.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    exit("ID inválido");
}

try {
    $stmt = $conn->prepare("DELETE FROM vehiculos WHERE idVehiculo = ?");
    $stmt->execute([$id]);

    echo "Vehículo eliminado correctamente";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
