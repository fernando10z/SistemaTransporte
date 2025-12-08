<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

if (!isset($_POST['id']) || !isset($_POST['tipo'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$id = $_POST['id'];
$tipo = $_POST['tipo'];

try {
    $conn->beginTransaction();
    
    if ($tipo == 'cliente') {
        // Eliminar seguimiento primero
        $sqlSeg = "DELETE FROM seguimiento_envioclientes WHERE idAsignacion = ?";
        $stmtSeg = $conn->prepare($sqlSeg);
        $stmtSeg->execute([$id]);
        
        // Luego eliminar la asignación
        $sql = "DELETE FROM asignacion_carga_cliente WHERE idAsignacion = ?";
    } else {
        // Eliminar seguimiento primero
        $sqlSeg = "DELETE FROM seguimiento_envioempresa WHERE idAsignacionEmpresa = ?";
        $stmtSeg = $conn->prepare($sqlSeg);
        $stmtSeg->execute([$id]);
        
        // Luego eliminar la asignación
        $sql = "DELETE FROM asignacion_carga_empresa WHERE idAsignacionEmpresa = ?";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Asignación eliminada correctamente']);
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al eliminar la asignación: ' . $e->getMessage()]);
}
?>