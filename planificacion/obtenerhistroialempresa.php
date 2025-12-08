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
                pre.idPlanificacionempresa,
                ce2.razonSocial AS empresa,
                CONDUCTOR.nombre AS nombre_conductor, 
                CONDUCTOR.Apepat AS apepat_conductor,
                CONDUCTOR.Apemat AS apemat_conductor,
                v.placa AS vehiculo,
                CONCAT(r.origen, ' - ', r.destino) AS ruta,
                pre.fechaPlanificada AS fecha_original,
                pre.horaPlanificada AS hora_original
            FROM planificacion_ruta_empresa pre
            JOIN asignacion_carga_empresa ace ON pre.idAsignacionEmpresa = ace.idAsignacionEmpresa
            JOIN cotizaciones_empresas ce ON ace.idCotizacionEmpresa = ce.idCotizacionEmpresa
            JOIN solicitud_empresa se ON ce.idSolicitudempresa = se.idSolicitudempresa
            JOIN clientes_empresas ce2 ON se.idEmpresa = ce2.idEmpresa
            JOIN conductores CONDUCTOR ON pre.idConductor = CONDUCTOR.idConductor
            JOIN vehiculos v ON pre.idVehiculo = v.idVehiculo
            JOIN rutas r ON pre.idRuta = r.idRuta
            WHERE pre.idPlanificacionempresa = ?";
    
    $stmtBase = $conn->prepare($sqlBase);
    $stmtBase->execute([$idPlanificacion]);
    $planificacionBase = $stmtBase->fetch(PDO::FETCH_ASSOC);
    
    if (!$planificacionBase) {
        throw new Exception('No se encontró la planificación base');
    }
    
    // Obtener reprogramaciones
    $sqlReprogramaciones = "SELECT 
                re.idReprogramacionempresa AS idReprogramacion,
                re.motivo,
                re.fechaReprogramada,
                re.horaReprogramada,
                re.estado,
                DATE_FORMAT(re.fechaRegistro, '%Y-%m-%d %H:%i:%s') AS fechaRegistro,
                :fecha_original AS fechaOriginal,
                :hora_original AS horaOriginal,
                :empresa AS cliente_empresa,
                CONCAT(:nombre_conductor, ' ', :apepat_conductor, ' ', :apemat_conductor) AS conductor,
                :vehiculo AS vehiculo,
                :ruta AS ruta
            FROM reprogramacionesEmpresa re
            WHERE re.idPlanificacionempresa = :id OR re.Planificacionoriginal = :id
            ORDER BY re.fechaRegistro DESC";
    
    $stmtReprogramaciones = $conn->prepare($sqlReprogramaciones);
    $stmtReprogramaciones->execute([
        ':id' => $idPlanificacion,
        ':fecha_original' => $planificacionBase['fecha_original'],
        ':hora_original' => $planificacionBase['hora_original'],
        ':empresa' => $planificacionBase['empresa'],
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