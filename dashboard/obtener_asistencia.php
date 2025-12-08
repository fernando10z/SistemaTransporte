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
        $whereConditions[] = "DATE(fecha_registro) = '$dia'";
    } else {
        if (!empty($anio)) {
            $whereConditions[] = "YEAR(fecha_registro) = '$anio'";
        }
        if (!empty($mes)) {
            $whereConditions[] = "MONTH(fecha_registro) = '$mes'";
        }
    }
    
    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
    
    // Obtener datos de asistencia por estado
    $sql = "SELECT 
                estado,
                COUNT(*) as cantidad
            FROM asistencia_conductores 
            $whereClause
            GROUP BY estado";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $labels = [];
    $valores = [];
    
    foreach ($resultados as $row) {
        $estado = $row['estado'];
        switch ($estado) {
            case 'Ingreso':
                $labels[] = 'Asistieron';
                break;
            case 'Justificado':
                $labels[] = 'Justificados';
                break;
            case 'Ausente':
                $labels[] = 'Ausentes';
                break;
            default:
                $labels[] = $estado;
        }
        $valores[] = intval($row['cantidad']);
    }
    
    // Si no hay datos
    if (empty($labels)) {
        $labels = ['Sin registros'];
        $valores = [0];
    }
    
    echo json_encode([
        'labels' => $labels,
        'valores' => $valores
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener datos de asistencia',
        'labels' => ['Sin datos'],
        'valores' => [0]
    ]);
}
?>