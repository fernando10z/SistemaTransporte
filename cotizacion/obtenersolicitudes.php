<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

try {
    $sql = "SELECT s.*, c.nombre, c.apellidopat, c.apellidoMat 
            FROM solicitudes_clientes s
            JOIN clientes_naturales c ON s.idCliente = c.idCliente
            WHERE s.estado = 'Pendiente'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (s.idSolicitud LIKE :busqueda OR s.origen LIKE :busqueda OR s.destino LIKE :busqueda)";
        $params = ['busqueda' => "%$busqueda%"];
    } else {
        $params = [];
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($solicitudes)) {
        echo json_encode(['error' => 'No se encontraron solicitudes pendientes']);
        exit;
    }
    
    echo json_encode($solicitudes);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>