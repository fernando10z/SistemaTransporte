<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $query = "SELECT 
                sc.idSeguimiento AS id_seguimiento,
                sc.codigoSeguimiento,
                sc.estadoEnvio AS estado_envio,
                DATE_FORMAT(sc.ultimaActualizacion, '%Y-%m-%d %H:%i:%s') AS ultima_actualizacion,
                CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS nombre_completo,
                td.tipoDocumento,
                cn.numerodocumento AS numero_documento,
                CONCAT(v.marca, ' ', v.modelo, ' (', v.placa, ')') AS vehiculo,
                sc.idAsignacion
              FROM seguimiento_envioclientes sc
              JOIN asignacion_carga_cliente ac ON sc.idAsignacion = ac.idAsignacion
              JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
              JOIN solicitudes_clientes s ON cc.idSolicitud = s.idSolicitud
              JOIN clientes_naturales cn ON s.idCliente = cn.idCliente
              JOIN tipoDocumento td ON cn.idTipoDocumento = td.idTipoDocumento
              JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
              WHERE sc.estadoEnvio IN ('En tránsito', 'Pendiente')
              ORDER BY sc.ultimaActualizacion DESC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'No se encontraron seguimientos pendientes o en tránsito']);
    }
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error al obtener seguimientos: ' . $e->getMessage()]);
}