<?php
require "../conexion/conexion.php";

$id = $_POST['id'] ?? '';
$tipo = $_POST['tipo'] ?? '';

try {
    if ($tipo === 'cliente') {
        $stmt = $conn->prepare("DELETE FROM eventos_envio_clientes WHERE idEvento = ?");
        $stmt->execute([$id]);
    } elseif ($tipo === 'empresa') {
        $stmt = $conn->prepare("DELETE FROM eventos_envio_empresa WHERE idEventoEnvio = ?");
        $stmt->execute([$id]);
    }

    echo json_encode(["success" => true, "message" => "Evento eliminado correctamente"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error al eliminar: " . $e->getMessage()]);
}
