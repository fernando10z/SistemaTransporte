<?php
require '../conexion/conexion.php';

$idAsignacion = $_POST['idAsignacion'];
$tipoAsignacion = $_POST['tipoAsignacion'];
$idCotizacion = $_POST['idCotizacion'];
$observaciones = $_POST['observaciones'];
$estado = $_POST['estado'];

try {
    $conn->beginTransaction();
    
    if($tipoAsignacion === 'cliente') {
        $query = "UPDATE asignacion_carga_cliente 
                  SET idCotizacion = :idCotizacion, 
                      observaciones = :observaciones, 
                      estado = :estado
                  WHERE idAsignacion = :idAsignacion";
    } else {
        $query = "UPDATE asignacion_carga_empresa 
                  SET idCotizacionEmpresa = :idCotizacion, 
                      observaciones = :observaciones, 
                      estado = :estado
                  WHERE idAsignacionEmpresa = :idAsignacion";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idAsignacion', $idAsignacion);
    $stmt->bindParam(':idCotizacion', $idCotizacion);
    $stmt->bindParam(':observaciones', $observaciones);
    $stmt->bindParam(':estado', $estado);
    $stmt->execute();
    
    $conn->commit();
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $e->getMessage()]);
}
?>