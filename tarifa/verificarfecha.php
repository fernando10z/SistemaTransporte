<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'error' => false,
    'message' => '',
    'data' => []
];

try {
    // Consulta SQL para obtener tarifas que vencen hoy, mañana o en 5 días
    $sql = "SELECT 
                t.idTarifa, 
                t.monto, 
                DATE_FORMAT(t.fechaVigencia, '%d/%m/%Y') as fechaVigencia,
                t.Estado,
                s.nombreServicio, 
                s.tipoCarga,
                z.nombreZona, 
                z.departamento,
                DATEDIFF(t.fechaVigencia, CURDATE()) AS dias
            FROM tarifas t
            JOIN servicios s ON t.idServicio = s.idServicio
            JOIN zonas_cobertura z ON t.idZona = z.idZona
            WHERE t.fechaVigencia IS NOT NULL
            AND t.Estado = 'Activo'
            AND DATEDIFF(t.fechaVigencia, CURDATE()) BETWEEN 0 AND 5
            ORDER BY dias ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tarifas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Procesar los resultados
    foreach ($tarifas as $tarifa) {
        // Clasificar por prioridad
        if ($tarifa['dias'] <= 1) { // Hoy o mañana
            $tarifa['prioridad'] = 'urgente';
        } else { // 2-5 días
            $tarifa['prioridad'] = 'aviso';
        }
        $response['data'][] = $tarifa;
    }

    $response['success'] = true;
    $response['message'] = count($tarifas) . ' tarifas próximas a vencer encontradas';

} catch(PDOException $e) {
    $response['error'] = true;
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
}

echo json_encode($response);
?>