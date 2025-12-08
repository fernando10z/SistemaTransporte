<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $alertas = [];
    $hoy = new DateTime();
    
    // Primero, actualizar mantenimientos vencidos (solo los Pendientes)
    $conn->beginTransaction();
    
    $sqlUpdate = "UPDATE mantenimiento_vehiculo 
                  SET estado = 'Vencido' 
                  WHERE estado = 'Pendiente' 
                  AND fecha_proxima_mantenimiento < :hoy";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([':hoy' => $hoy->format('Y-m-d')]);
    
    // Obtener solo mantenimientos Pendientes (no incluir Vencidos)
    $sql = "SELECT m.idMantenimiento, 
                   CONCAT(v.placa, ' - ', v.marca, ' ', v.modelo) as vehiculo,
                   m.fecha_proxima_mantenimiento
            FROM mantenimiento_vehiculo m
            JOIN vehiculos v ON m.idVehiculo = v.idVehiculo
            WHERE m.estado = 'Pendiente'
            AND m.fecha_proxima_mantenimiento IS NOT NULL
            ORDER BY m.fecha_proxima_mantenimiento ASC";
    
    $stmt = $conn->query($sql);
    $mantenimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($mantenimientos as $mantenimiento) {
        $fechaMantenimiento = new DateTime($mantenimiento['fecha_proxima_mantenimiento']);
        $diferencia = $hoy->diff($fechaMantenimiento);
        $diasDiferencia = $diferencia->days;
        $esPasado = $fechaMantenimiento < $hoy;
        
        // Solo crear alertas para fechas pasadas o próximas (hasta 5 días)
        if ($esPasado || $diasDiferencia <= 5) {
            if ($esPasado) {
                $alertas[] = [
                    'tipo' => 'urgente',
                    'vehiculo' => $mantenimiento['vehiculo'],
                    'mensaje' => 'Mantenimiento vencido desde hace ' . $diasDiferencia . ' días',
                    'fecha' => $mantenimiento['fecha_proxima_mantenimiento'],
                    'dias' => -$diasDiferencia,
                    'id' => $mantenimiento['idMantenimiento']
                ];
            } else {
                $tipo = ($diasDiferencia <= 1) ? 'urgente' : 'aviso';
                $mensaje = ($diasDiferencia === 0) ? 'Mantenimiento programado para hoy' : 
                          (($diasDiferencia === 1) ? 'Mantenimiento programado para mañana' : 
                          'Mantenimiento programado en ' . $diasDiferencia . ' días');
                
                $alertas[] = [
                    'tipo' => $tipo,
                    'vehiculo' => $mantenimiento['vehiculo'],
                    'mensaje' => $mensaje,
                    'fecha' => $mantenimiento['fecha_proxima_mantenimiento'],
                    'dias' => $diasDiferencia,
                    'id' => $mantenimiento['idMantenimiento']
                ];
            }
        }
    }
    
    $conn->commit();
    echo json_encode($alertas);
    
} catch(PDOException $e) {
    $conn->rollBack();
    echo json_encode([
        'error' => 'Error en la base de datos',
        'details' => $e->getMessage()
    ]);
} catch(Exception $e) {
    echo json_encode([
        'error' => 'Error general',
        'details' => $e->getMessage()
    ]);
}
?>