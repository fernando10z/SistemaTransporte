<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$busqueda = $_POST['busqueda'] ?? '';

try {
    $sql = "SELECT a.idAsignacion as id, 
                   CONCAT('ASG-', a.idAsignacion) as codigo,
                   CONCAT(c.nombre, ' ', c.apellidopat) as cliente,
                   s.origen, 
                   s.destino,
                   a.estado
            FROM asignacion_carga_cliente a
            JOIN cotizaciones_clientes co ON a.idCotizacion = co.idCotizacion
            JOIN solicitudes_clientes s ON co.idSolicitud = s.idSolicitud
            JOIN clientes_naturales c ON s.idCliente = c.idCliente
            WHERE a.estado = 'Pendiente'
            AND (c.nombre LIKE :busqueda OR 
                 c.apellidopat LIKE :busqueda OR 
                 s.destino LIKE :busqueda OR
                 CONCAT('ASG-', a.idAsignacion) LIKE :busqueda)";
    
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