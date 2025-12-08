<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php'; // tu script PDO

$id = $_POST['id'] ?? 0;

try {
    $del = $conn->prepare("DELETE FROM mantenimiento_vehiculo WHERE idMantenimiento = ?");
    $del->execute([$id]);

    if ($del->rowCount() === 0) {
        throw new Exception('Registro no encontrado o ya eliminado');
    }

    echo json_encode(['ok' => true, 'msg' => 'Registro eliminado correctamente']);
} catch (Exception $e) {
    echo json_encode(['ok' => false, 'msg' => $e->getMessage()]);
}
?>
