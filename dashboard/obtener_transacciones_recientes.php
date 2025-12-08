<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$anio = $_GET['anio'] ?? '';
$mes = $_GET['mes'] ?? '';
$dia = $_GET['dia'] ?? '';

try {
    // Construir condiciones WHERE
    $whereConditions = [];
    
    if (!empty($dia)) {
        $whereConditions[] = "DATE(fecha) = '$dia'";
    } else {
        if (!empty($anio)) {
            $whereConditions[] = "YEAR(fecha) = '$anio'";
        }
        if (!empty($mes)) {
            $whereConditions[] = "MONTH(fecha) = '$mes'";
        }
    }
    
    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
    
    // Obtener transacciones recientes
    $sql = "SELECT 
                fecha,
                tipo,
                concepto,
                monto,
                metodo_pago,
                estado,
                fecha_registro
            FROM transacciones_financieras 
            $whereClause
            ORDER BY fecha_registro DESC 
            LIMIT 10";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Formatear las fechas
    foreach ($resultados as &$transaccion) {
        $transaccion['fecha'] = date('d/m/Y', strtotime($transaccion['fecha']));
        $transaccion['monto'] = floatval($transaccion['monto']);
    }
    
    echo json_encode($resultados);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener transacciones recientes'
    ]);
}
?>