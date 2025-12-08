<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$anio = $_GET['anio'] ?? '';
$mes = $_GET['mes'] ?? '';
$dia = $_GET['dia'] ?? '';

try {
    // Métricas que no dependen de fecha
    // Conductores activos
    $stmt = $conn->query("SELECT COUNT(*) as total FROM conductores WHERE estado = 'Activo'");
    $conductores_activos = $stmt->fetch()['total'];
    
    // Vehículos disponibles
    $stmt = $conn->query("SELECT COUNT(*) as total FROM vehiculos WHERE estado = 'Disponible'");
    $vehiculos_disponibles = $stmt->fetch()['total'];
    
    // Construir condiciones WHERE para métricas con fecha
    $whereConditions = ["estado = 'Activo'"];
    $whereConditionsSolicitudes = [];
    
    if (!empty($dia)) {
        $whereConditions[] = "DATE(fecha) = '$dia'";
        $whereConditionsSolicitudes[] = "DATE(fechaRegistro) = '$dia'";
    } else {
        if (!empty($anio)) {
            $whereConditions[] = "YEAR(fecha) = '$anio'";
            $whereConditionsSolicitudes[] = "YEAR(fechaRegistro) = '$anio'";
        }
        if (!empty($mes)) {
            $whereConditions[] = "MONTH(fecha) = '$mes'";
            $whereConditionsSolicitudes[] = "MONTH(fechaRegistro) = '$mes'";
        }
    }
    
    // Solicitudes pendientes con filtro de fecha
    $whereClauseSolicitudes = !empty($whereConditionsSolicitudes) ? 'WHERE estado = \'Pendiente\' AND ' . implode(' AND ', $whereConditionsSolicitudes) : 'WHERE estado = \'Pendiente\'';
    
    $sql = "SELECT COUNT(*) as total FROM solicitudes_clientes $whereClauseSolicitudes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $solicitudes_pendientes_clientes = $stmt->fetch()['total'];
    
    $sql = "SELECT COUNT(*) as total FROM solicitud_empresa $whereClauseSolicitudes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $solicitudes_pendientes_empresas = $stmt->fetch()['total'];
    
    $solicitudes_pendientes = $solicitudes_pendientes_clientes + $solicitudes_pendientes_empresas;
    
    // Ganancias (ingresos - egresos) con filtro de fecha
    $whereClauseFinanzas = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : 'WHERE estado = \'Activo\'';
    
    $sql = "SELECT 
                SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) as ingresos,
                SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) as egresos 
            FROM transacciones_financieras 
            $whereClauseFinanzas";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $finanzas = $stmt->fetch();
    
    $ingresos = floatval($finanzas['ingresos'] ?? 0);
    $egresos = floatval($finanzas['egresos'] ?? 0);
    $ganancia = $ingresos - $egresos;
    
    echo json_encode([
        'conductores_activos' => intval($conductores_activos),
        'vehiculos_disponibles' => intval($vehiculos_disponibles),
        'solicitudes_pendientes' => intval($solicitudes_pendientes),
        'ganancia' => $ganancia,
        'ingresos' => $ingresos,
        'egresos' => $egresos
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'error' => 'Error al obtener métricas',
        'conductores_activos' => 0,
        'vehiculos_disponibles' => 0,
        'solicitudes_pendientes' => 0,
        'ganancia' => 0,
        'ingresos' => 0,
        'egresos' => 0
    ]);
}
?>