<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $query = "SELECT 
                se.idSeguimientoEmpresa AS id_seguimiento,
                se.codigoSeguimiento,
                se.estadoEnvio AS estado_envio,
                DATE_FORMAT(se.ultimaActualizacion, '%Y-%m-%d %H:%i:%s') AS ultima_actualizacion,
                ce.razonSocial AS razon_social,
                ce.ruc,
                CONCAT(v.marca, ' ', v.modelo, ' (', v.placa, ')') AS vehiculo,
                se.idAsignacionEmpresa
              FROM seguimiento_envioempresa se
              JOIN asignacion_carga_empresa ae ON se.idAsignacionEmpresa = ae.idAsignacionEmpresa
              JOIN cotizaciones_empresas cc ON ae.idCotizacionEmpresa = cc.idCotizacionEmpresa
              JOIN solicitud_empresa s ON cc.idSolicitudempresa = s.idSolicitudempresa
              JOIN clientes_empresas ce ON s.idEmpresa = ce.idEmpresa
              JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
              WHERE se.estadoEnvio IN ('En tránsito', 'Pendiente')
              ORDER BY se.ultimaActualizacion DESC";

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