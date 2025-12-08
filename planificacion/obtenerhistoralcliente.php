<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('ID de planificación no válido');
    }
    
    $idPlanificacion = (int)$_GET['id'];
    
    // Obtener información base de la planificación
    $sqlBase = "SELECT 
                pr.idPlanificacion,
                CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS cliente,
                CONDUCTOR.nombre AS nombre_conductor, 
                CONDUCTOR.Apepat AS apepat_conductor,
                CONDUCTOR.Apemat AS apemat_conductor,
                v.placa AS vehiculo,
                CONCAT(r.origen, ' - ', r.destino) AS ruta,
                pr.fechaPlanificada AS fecha_original,
                pr.horaPlanificada AS hora_original
            FROM planificacion_ruta pr
            JOIN asignacion_carga_cliente ac ON pr.idAsignacion = ac.idAsignacion
            JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
            JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
            JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
            JOIN conductores CONDUCTOR ON pr.idConductor = CONDUCTOR.idConductor
            JOIN vehiculos v ON pr.idVehiculo = v.idVehiculo
            JOIN rutas r ON pr.idRuta = r.idRuta
            WHERE pr.idPlanificacion = ?";
    
    $stmtBase = $conn->prepare($sqlBase);
    $stmtBase->execute([$idPlanificacion]);
    $planificacionBase = $stmtBase->fetch(PDO::FETCH_ASSOC);
    
    if (!$planificacionBase) {
        throw new Exception('No se encontró la planificación base');
    }
    
    // Obtener reprogramaciones
    $sqlReprogramaciones = "SELECT 
                rc.idReprogramacion,
                rc.motivo,
                rc.fechaReprogramada,
                rc.horaReprogramada,
                rc.estado,
                DATE_FORMAT(rc.fechaRegistro, '%Y-%m-%d %H:%i:%s') AS fechaRegistro,
                :fecha_original AS fechaOriginal,
                :hora_original AS horaOriginal,
                :cliente AS cliente_empresa,
                CONCAT(:nombre_conductor, ' ', :apepat_conductor, ' ', :apemat_conductor) AS conductor,
                :vehiculo AS vehiculo,
                :ruta AS ruta
            FROM reprogramacionescliente rc
            WHERE rc.idPlanificacion = :id OR rc.Planificacionoriginal = :id
            ORDER BY rc.fechaRegistro DESC";
    
    $stmtReprogramaciones = $conn->prepare($sqlReprogramaciones);
    $stmtReprogramaciones->execute([
        ':id' => $idPlanificacion,
        ':fecha_original' => $planificacionBase['fecha_original'],
        ':hora_original' => $planificacionBase['hora_original'],
        ':cliente' => $planificacionBase['cliente'],
        ':nombre_conductor' => $planificacionBase['nombre_conductor'],
        ':apepat_conductor' => $planificacionBase['apepat_conductor'],
        ':apemat_conductor' => $planificacionBase['apemat_conductor'],
        ':vehiculo' => $planificacionBase['vehiculo'],
        ':ruta' => $planificacionBase['ruta']
    ]);
    
    $reprogramaciones = $stmtReprogramaciones->fetchAll(PDO::FETCH_ASSOC);
    
 
    
    echo json_encode($reprogramaciones ?: []);
    
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>