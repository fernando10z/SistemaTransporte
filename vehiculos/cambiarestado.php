<?php
require '../conexion/conexion.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    exit("ID inválido");
}

try {
    // Obtener estado actual
    $stmt = $conn->prepare("SELECT estado FROM vehiculos WHERE idVehiculo = ?");
    $stmt->execute([$id]);
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehiculo) {
        exit("Vehículo no encontrado");
    }

    $nuevoEstado = ($vehiculo['estado'] === 'Disponible') ? 'Ocupado' : 'Disponible';

    $stmt = $conn->prepare("UPDATE vehiculos SET estado = ? WHERE idVehiculo = ?");
    $stmt->execute([$nuevoEstado, $id]);

    echo "Estado cambiado a '$nuevoEstado'";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
