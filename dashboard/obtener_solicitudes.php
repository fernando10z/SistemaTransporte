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
        $whereConditions[] = "DATE(fechaRegistro) = '$dia'";
    } else {
        if (!empty($anio)) {
            $whereConditions[] = "YEAR(fechaRegistro) = '$anio'";
        }
        if (!empty($mes)) {
            $whereConditions[] = "MONTH(fechaRegistro) = '$mes'";
        }
    }
    
    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
    
    // Obtener estados de solicitudes de clientes
    $sql = "SELECT 
                estado,
                COUNT(*) as cantidad
            FROM solicitudes_clientes 
            $whereClause
            GROUP BY estado";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $solicitudesClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obtener estados de solicitudes de empresas
    $sql = "SELECT 
                estado,
                COUNT(*) as cantidad
            FROM solicitud_empresa 
            $whereClause
            GROUP BY estado";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $solicitudesEmpresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Combinar resultados
    $estadosContador = [];
    
    foreach ($solicitudesClientes as $row) {
        $estado = ucfirst($row['estado']);
        $estadosContador[$estado] = ($estadosContador[$estado] ?? 0) + $row['cantidad'];
    }
    
    foreach ($solicitudesEmpresas as $row) {
        $estado = ucfirst($row['estado']);
        $estadosContador[$estado] = ($estadosContador[$estado] ?? 0) + $row['cantidad'];
    }
    
    $labels = array_keys($estadosContador);
    $valores = array_values($estadosContador);
    
    // Si no hay datos, mostrar mensaje
    if (empty($labels)) {
        $labels = ['Sin solicitudes'];
        $valores = [1];
    }
    
    echo json_encode([
        'labels' => $labels,
        'valores' => $valores
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener datos de solicitudes',
        'labels' => ['Sin datos'],
        'valores' => [1]
    ]);
}
?>