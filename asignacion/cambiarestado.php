<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

if (!isset($_POST['id']) || !isset($_POST['tipo']) || !isset($_POST['estado'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$id = $_POST['id'];
$tipo = $_POST['tipo'];
$nuevoEstado = $_POST['estado'];

try {
    if ($tipo == 'cliente') {
        // Actualizar estado en asignacion_carga_cliente
        $sql = "UPDATE asignacion_carga_cliente SET estado = ? WHERE idAsignacion = ?";
        
        // Actualizar también en seguimiento si existe
        $sqlSeg = "UPDATE seguimiento_envioclientes SET estadoEnvio = ? WHERE idAsignacion = ?";
    } else {
        // Actualizar estado en asignacion_carga_empresa
        $sql = "UPDATE asignacion_carga_empresa SET estado = ? WHERE idAsignacionEmpresa = ?";
        
        // Actualizar también en seguimiento si existe
        $sqlSeg = "UPDATE seguimiento_envioempresa SET estadoEnvio = ? WHERE idAsignacionEmpresa = ?";
    }
    
    $conn->beginTransaction();
    
    // Actualizar estado principal
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nuevoEstado, $id]);
    
    // Actualizar estado de seguimiento si corresponde
    if ($nuevoEstado == 'En tránsito' || $nuevoEstado == 'Entregado' || $nuevoEstado == 'Cancelado') {
        $estadoSeg = ($nuevoEstado == 'Cancelado') ? 'Cancelado' : $nuevoEstado;
        $stmtSeg = $conn->prepare($sqlSeg);
        $stmtSeg->execute([$estadoSeg, $id]);
    }
    
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado: ' . $e->getMessage()]);
}
?>