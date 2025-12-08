<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$anio = $_GET['anio'] ?? '';
$mes = $_GET['mes'] ?? '';
$dia = $_GET['dia'] ?? '';

try {
    // Construir condiciones WHERE dinámicamente
    $whereConditions = ["estado = 'Activo'"];
    
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
    
    $whereClause = implode(' AND ', $whereConditions);
    
    // Consulta para obtener datos financieros agrupados
    if (!empty($dia)) {
        // Por horas del día
        $sql = "SELECT 
                    HOUR(fecha_registro) as periodo,
                    SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) as ingresos,
                    SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) as egresos
                FROM transacciones_financieras 
                WHERE $whereClause
                GROUP BY HOUR(fecha_registro)
                ORDER BY periodo";
    } else if (!empty($mes) && !empty($anio)) {
        // Por días del mes
        $sql = "SELECT 
                    DAY(fecha) as periodo,
                    SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) as ingresos,
                    SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) as egresos
                FROM transacciones_financieras 
                WHERE $whereClause
                GROUP BY DAY(fecha)
                ORDER BY periodo";
    } else {
        // Por meses del año
        $sql = "SELECT 
                    MONTH(fecha) as periodo,
                    SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) as ingresos,
                    SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) as egresos
                FROM transacciones_financieras 
                WHERE $whereClause
                GROUP BY MONTH(fecha)
                ORDER BY periodo";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $ingresos = [];
    $egresos = [];
    
    if (!empty($dia)) {
        // Etiquetas por horas
        for ($i = 0; $i < 24; $i++) {
            $labels[] = $i . ':00';
            $ingresos[] = 0;
            $egresos[] = 0;
        }
        foreach ($resultados as $row) {
            $ingresos[$row['periodo']] = floatval($row['ingresos']);
            $egresos[$row['periodo']] = floatval($row['egresos']);
        }
    } else if (!empty($mes) && !empty($anio)) {
        // Etiquetas por días del mes
        $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        for ($i = 1; $i <= $diasEnMes; $i++) {
            $labels[] = $i;
            $ingresos[] = 0;
            $egresos[] = 0;
        }
        foreach ($resultados as $row) {
            $ingresos[$row['periodo'] - 1] = floatval($row['ingresos']);
            $egresos[$row['periodo'] - 1] = floatval($row['egresos']);
        }
    } else {
        // Etiquetas por meses
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $meses[$i - 1];
            $ingresos[] = 0;
            $egresos[] = 0;
        }
        foreach ($resultados as $row) {
            $ingresos[$row['periodo'] - 1] = floatval($row['ingresos']);
            $egresos[$row['periodo'] - 1] = floatval($row['egresos']);
        }
    }
    
    echo json_encode([
        'labels' => $labels,
        'ingresos' => $ingresos,
        'egresos' => $egresos
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener datos financieros',
        'labels' => [],
        'ingresos' => [],
        'egresos' => []
    ]);
}
?>