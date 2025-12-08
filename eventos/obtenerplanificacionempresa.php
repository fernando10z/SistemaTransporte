<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $query = "SELECT 
                pre.idPlanificacionempresa AS id_planificacion,
                ce.razonSocial,
                ce.ruc,
               CONCAT(r.origen, ' - ', r.destino) AS ruta,
            CONCAT(co.nombre, ' ', co.Apepat, ' ', IFNULL(co.Apemat, '')) AS conductor,
                DATE_FORMAT(pre.fechaPlanificada, '%d/%m/%Y') AS fecha_planificada,
                TIME_FORMAT(pre.horaPlanificada, '%H:%i') AS hora_planificada
              FROM planificacion_ruta_empresa pre
              JOIN asignacion_carga_empresa ace ON pre.idAsignacionEmpresa = ace.idAsignacionEmpresa
              JOIN cotizaciones_empresas cce ON ace.idCotizacionEmpresa = cce.idCotizacionEmpresa
              JOIN solicitud_empresa se ON cce.idSolicitudempresa = se.idSolicitudempresa
              JOIN clientes_empresas ce ON se.idEmpresa = ce.idEmpresa
              JOIN rutas r ON pre.idRuta = r.idRuta
              JOIN conductores co ON pre.idConductor = co.idConductor
              WHERE pre.estado IN ('Planificado', 'Reprogramado')";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
}
?>