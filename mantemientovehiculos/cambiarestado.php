<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php'; // tu script PDO

$id = $_POST['id'] ?? 0;

try {
    // Obtén estado actual
    $stmt = $conn->prepare("SELECT estado FROM mantenimiento_vehiculo WHERE idMantenimiento = ?");
    $stmt->execute([$id]);
    $estadoActual = $stmt->fetchColumn();

    if (!$estadoActual) {
        throw new Exception('Registro no encontrado');
    }

    // Define la transición simple
    $siguiente = match ($estadoActual) {
        'Pendiente' => 'Realizado',
        'Realizado' => 'Vencido',
        default      => 'Pendiente',
    };

    // Actualiza
    $update = $conn->prepare("UPDATE mantenimiento_vehiculo SET estado = ? WHERE idMantenimiento = ?");
    $update->execute([$siguiente, $id]);

    echo json_encode(['ok' => true, 'msg' => "Nuevo estado: $siguiente"]);
} catch (Exception $e) {
    echo json_encode(['ok' => false, 'msg' => $e->getMessage()]);
}
?>
