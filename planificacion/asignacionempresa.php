<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$busqueda = $_POST['busqueda'] ?? '';

try {
    $sql = "SELECT a.idAsignacionEmpresa as id, 
                   CONCAT('ASG-E-', a.idAsignacionEmpresa) as codigo,
                   e.razonSocial as empresa,
                   e.ruc,
                   s.destino,
                   a.estado
            FROM asignacion_carga_empresa a
            JOIN cotizaciones_empresas co ON a.idCotizacionEmpresa = co.idCotizacionEmpresa
            JOIN solicitud_empresa s ON co.idSolicitudempresa = s.idSolicitudempresa
            JOIN clientes_empresas e ON s.idEmpresa = e.idEmpresa
            WHERE a.estado = 'Pendiente'
            AND (e.razonSocial LIKE :busqueda OR 
                 e.ruc LIKE :busqueda OR 
                 s.destino LIKE :busqueda OR
                 CONCAT('ASG-E-', a.idAsignacionEmpresa) LIKE :busqueda)";
    
    $stmt = $conn->prepare($sql);
    $busquedaParam = "%$busqueda%";
    $stmt->bindParam(':busqueda', $busquedaParam);
    $stmt->execute();
    
    $asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $asignaciones
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>