<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $query = "SELECT 
                pr.idPlanificacion,
                CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', IFNULL(cn.apellidoMat, '')) AS nombre_completo,
                td.tipoDocumento AS tipo_documento,
                cn.numerodocumento AS numero_documento,
               CONCAT(r.origen, ' - ', r.destino) AS ruta,
            CONCAT(co.nombre, ' ', co.Apepat, ' ', IFNULL(co.Apemat, '')) AS conductor,
                DATE_FORMAT(pr.fechaPlanificada, '%d/%m/%Y') AS fecha_planificada,
                TIME_FORMAT(pr.horaPlanificada, '%H:%i') AS hora_planificada
              FROM planificacion_ruta pr
              JOIN asignacion_carga_cliente ac ON pr.idAsignacion = ac.idAsignacion
              JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
              JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
              JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
              JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
              JOIN rutas r ON pr.idRuta = r.idRuta
              JOIN conductores co ON pr.idConductor = co.idConductor
              WHERE pr.estado IN ('Planificado', 'Reprogramado')";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
}
?>