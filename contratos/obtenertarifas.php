<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    
    $sql = "SELECT t.idTarifa, t.monto, t.observaciones, t.fechaVigencia, t.Estado,
                   s.idServicio, s.nombreServicio, s.descripcion AS descripcionServicio,
                   z.idZona, z.nombreZona, z.departamento, z.provincia, z.distrito
            FROM tarifas t
            JOIN servicios s ON t.idServicio = s.idServicio
            JOIN zonas_cobertura z ON t.idZona = z.idZona
            WHERE t.Estado = 'Activo' 
            AND s.Estado = 'Activo'
            AND z.Estado = 'Activo'";
    
    if (!empty($filtro)) {
        $sql .= " AND (s.nombreServicio LIKE :filtro 
                      OR z.nombreZona LIKE :filtro 
                      OR CONCAT(z.departamento, ' ', z.provincia, ' ', z.distrito) LIKE :filtro)";
    }
    
    $sql .= " ORDER BY s.nombreServicio, z.nombreZona";
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($filtro)) {
        $filtroParam = "%$filtro%";
        $stmt->bindParam(':filtro', $filtroParam);
    }
    
    $stmt->execute();
    $tarifas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $response = [
        'success' => true,
        'data' => array_map(function($tarifa) {
            return [
                'idTarifa' => (int)$tarifa['idTarifa'],
                'nombreServicio' => $tarifa['nombreServicio'],
                'nombreZona' => $tarifa['nombreZona'],
                'monto' => (float)$tarifa['monto'],
                'ubicacion' => $tarifa['departamento'].', '.$tarifa['provincia'].', '.$tarifa['distrito'],
                'fechaVigencia' => $tarifa['fechaVigencia']
            ];
        }, $tarifas)
    ];
    
    echo json_encode($response);
    
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Error al obtener las tarifas: ' . $e->getMessage()
    ];
    echo json_encode($response);
}
?>