<?php
require "../conexion/conexion.php";

$id = $_POST['idEvento'] ?? '';
$tipo = $_POST['tipoEnvios'] ?? '';
$nuevoEstado = $_POST['nuevoEstado'] ?? '';

try {
    $conn->beginTransaction();

    if ($tipo === 'cliente') {
        // Actualiza el estado en eventos
        $stmt = $conn->prepare("UPDATE eventos_envio_clientes SET tipoSeguimiento = ? WHERE idEvento = ?");
        $stmt->execute([$nuevoEstado, $id]);

        if ($nuevoEstado === 'Entregado') {
            $stmt = $conn->prepare("SELECT idSeguimiento FROM eventos_envio_clientes WHERE idEvento = ?");
            $stmt->execute([$id]);
            $idSeguimiento = $stmt->fetchColumn();

            $stmt = $conn->prepare("UPDATE seguimiento_envioclientes SET estadoEnvio = ? WHERE idSeguimiento = ?");
            $stmt->execute([$nuevoEstado, $idSeguimiento]);

            $stmt = $conn->prepare("SELECT idAsignacion FROM seguimiento_envioclientes WHERE idSeguimiento = ?");
            $stmt->execute([$idSeguimiento]);
            $idAsignacion = $stmt->fetchColumn();

            $stmt = $conn->prepare("UPDATE asignacion_carga_cliente SET estado = ? WHERE idAsignacion = ?");
            $stmt->execute([$nuevoEstado, $idAsignacion]);
        }

    } elseif ($tipo === 'empresa') {
        $stmt = $conn->prepare("UPDATE eventos_envio_empresa SET tipoSeguimiento = ? WHERE idEventoEnvio = ?");
        $stmt->execute([$nuevoEstado, $id]);

        if ($nuevoEstado === 'Entregado') {
            $stmt = $conn->prepare("SELECT idSeguimientoEmpresa FROM eventos_envio_empresa WHERE idEventoEnvio = ?");
            $stmt->execute([$id]);
            $idSeguimiento = $stmt->fetchColumn();

            $stmt = $conn->prepare("UPDATE seguimiento_envioempresa SET estadoEnvio = ? WHERE idSeguimientoEmpresa = ?");
            $stmt->execute([$nuevoEstado, $idSeguimiento]);

            $stmt = $conn->prepare("SELECT idAsignacionEmpresa FROM seguimiento_envioempresa WHERE idSeguimientoEmpresa = ?");
            $stmt->execute([$idSeguimiento]);
            $idAsignacion = $stmt->fetchColumn();

            $stmt = $conn->prepare("UPDATE asignacion_carga_empresa SET estado = ? WHERE idAsignacionEmpresa = ?");
            $stmt->execute([$nuevoEstado, $idAsignacion]);
        }
    }

    $conn->commit();
    echo json_encode(["success" => true, "message" => "Estado actualizado correctamente a '$nuevoEstado'"]);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
