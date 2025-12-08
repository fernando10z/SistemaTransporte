<?php
require '../conexion/conexion.php';

$id = $_POST['id'] ?? null;
$tipo = $_POST['tipo'] ?? null;

if (!$id || !$tipo) {
    exit("Datos inválidos");
}

try {
    if ($tipo === "Natural") {
        // Obtener estado actual
        $stmt = $conn->prepare("SELECT estado FROM solicitudes_clientes WHERE idSolicitud = ?");
        $stmt->execute([$id]);
        $estadoActual = $stmt->fetchColumn();

        // Determinar nuevo estado
        $nuevoEstado = ($estadoActual === 'Entregado') ? 'Anulado' : 'Entregado';

        // Actualizar estado
        $stmt = $conn->prepare("UPDATE solicitudes_clientes SET estado = ? WHERE idSolicitud = ?");
        $stmt->execute([$nuevoEstado, $id]);

    } else {
        // Obtener estado actual
        $stmt = $conn->prepare("SELECT estado FROM solicitud_empresa WHERE idSolicitudempresa = ?");
        $stmt->execute([$id]);
        $estadoActual = $stmt->fetchColumn();

        // Determinar nuevo estado
        $nuevoEstado = ($estadoActual === 'entregado') ? 'Anulado' : 'entregado';

        // Actualizar estado
        $stmt = $conn->prepare("UPDATE solicitud_empresa SET estado = ? WHERE idSolicitudempresa = ?");
        $stmt->execute([$nuevoEstado, $id]);
    }

    echo "Estado cambiado a '$nuevoEstado'";
} catch (PDOException $e) {
    echo "Error al cambiar estado: " . $e->getMessage();
}
