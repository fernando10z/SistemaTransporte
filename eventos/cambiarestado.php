<?php
include '../conexion/conexion.php';

$id = $_POST['idEvento'];
$tipo = $_POST['tipo'];
$nuevoEstado = $_POST['nuevoEstado'];

try {
    $conn->beginTransaction();

    if ($tipo === 'cliente') {
        // Actualizar tipoEvento en eventos_ruta
        $sql = "UPDATE eventos_ruta SET tipoEvento = :estado WHERE idEvento = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':estado', $nuevoEstado);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Obtener idPlanificacion e idAsignacion
        $sql = "SELECT pr.idPlanificacion, a.idAsignacion
                FROM eventos_ruta e
                JOIN planificacion_ruta pr ON e.idPlanificacion = pr.idPlanificacion
                JOIN asignacion_carga_cliente a ON pr.idAsignacion = a.idAsignacion
                WHERE e.idEvento = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos && in_array($nuevoEstado, ['Completado', 'Cancelado'])) {
            $idPlanificacion = $datos['idPlanificacion'];
            $idAsignacion = $datos['idAsignacion'];

            // Actualizar planificación
            $conn->prepare("UPDATE planificacion_ruta SET estado = ? WHERE idPlanificacion = ?")
                 ->execute([$nuevoEstado, $idPlanificacion]);

            // Actualizar asignación
            $estadoCarga = $nuevoEstado === 'Completado' ? 'Entregado' : 'Cancelado';
            $conn->prepare("UPDATE asignacion_carga_cliente SET estado = ? WHERE idAsignacion = ?")
                 ->execute([$estadoCarga, $idAsignacion]);

            // Actualizar seguimiento
            $conn->prepare("UPDATE seguimiento_envioclientes SET estadoEnvio = ?, ultimaActualizacion = NOW() WHERE idAsignacion = ?")
                 ->execute([$estadoCarga, $idAsignacion]);
        }

    } else {
        // Actualizar tipoEvento en eventos_ruta_empresa
        $sql = "UPDATE eventos_ruta_empresa SET tipoEvento = :estado WHERE idEvento = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':estado', $nuevoEstado);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Obtener idPlanificacionEmpresa e idAsignacionEmpresa
        $sql = "SELECT pe.idPlanificacionempresa, a.idAsignacionempresa
                FROM eventos_ruta_empresa e
                JOIN planificacion_ruta_empresa pe ON e.idPlanificacionempresa = pe.idPlanificacionempresa
                JOIN asignacion_carga_empresa a ON pe.idAsignacionempresa = a.idAsignacionempresa
                WHERE e.idEvento = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos && in_array($nuevoEstado, ['Completado', 'Cancelado'])) {
            $idPlanificacionEmpresa = $datos['idPlanificacionempresa'];
            $idAsignacionEmpresa = $datos['idAsignacionempresa'];

            // Actualizar planificación
            $conn->prepare("UPDATE planificacion_ruta_empresa SET estado = ? WHERE idPlanificacionempresa = ?")
                 ->execute([$nuevoEstado, $idPlanificacionEmpresa]);

            // Actualizar asignación
            $estadoCarga = $nuevoEstado === 'Completado' ? 'Entregado' : 'Cancelado';
            $conn->prepare("UPDATE asignacion_carga_empresa SET estado = ? WHERE idAsignacionempresa = ?")
                 ->execute([$estadoCarga, $idAsignacionEmpresa]);

            // Actualizar seguimiento
            $conn->prepare("UPDATE seguimiento_envioempresa SET estadoEnvio = ?, ultimaActualizacion = NOW() WHERE idAsignacionempresa = ?")
                 ->execute([$estadoCarga, $idAsignacionEmpresa]);
        }
    }

    $conn->commit();
    echo "Estado actualizado correctamente.";
} catch (PDOException $e) {
    $conn->rollBack();
    echo "Error al actualizar: " . $e->getMessage();
}
