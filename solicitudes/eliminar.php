<?php
require '../conexion/conexion.php';

$id = $_POST['id'] ?? null;
$tipo = $_POST['tipo'] ?? null;

if (!$id || !$tipo) {
    exit("Datos inválidos");
}

try {
    if ($tipo === "Natural") {
        $stmt = $conn->prepare("DELETE FROM solicitudes_clientes WHERE idSolicitud = ?");
    } else {
        $stmt = $conn->prepare("DELETE FROM solicitud_empresa WHERE idSolicitudempresa = ?");
    }

    $stmt->execute([$id]);
    echo "Solicitud eliminada correctamente";
} catch (PDOException $e) {
    echo "Error al eliminar: " . $e->getMessage();
}
