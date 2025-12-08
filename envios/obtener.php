<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idEvento = $_GET['idEvento'] ?? null;
    $tipoEnvio = $_GET['tipoEnvio'] ?? null;
    
    if(!$idEvento || !$tipoEnvio) {
        throw new Exception('Faltan parámetros requeridos');
    }
    
    if($tipoEnvio === 'cliente') {
        $query = "SELECT 
                    e.idEvento,
                    e.idSeguimiento,
                    e.tipoSeguimiento,
                    e.latitud,
                    e.longitud,
                    e.observaciones,
                    DATE_FORMAT(e.fechaEvento, '%Y-%m-%dT%H:%i') AS fechaEvento,
                    seg.codigoSeguimiento,
                    CONCAT(c.nombre, ' ', c.apellidopat, ' ', c.apellidoMat) AS remitente,
                    CONCAT(v.marca, ' ', v.modelo, ' (', v.placa, ')') AS vehiculo
                  FROM eventos_envio_clientes e
                  JOIN seguimiento_envioclientes seg ON e.idSeguimiento = seg.idSeguimiento
                  JOIN asignacion_carga_cliente ac ON seg.idAsignacion = ac.idAsignacion
                  JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
                  JOIN solicitudes_clientes s ON cc.idSolicitud = s.idSolicitud
                  JOIN clientes_naturales c ON s.idCliente = c.idCliente
                  JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
                  WHERE e.idEvento = ?";
    } else {
        $query = "SELECT 
                    e.idEventoEnvio AS idEvento,
                    e.idSeguimientoEmpresa AS idSeguimiento,
                    e.tipoSeguimiento,
                    e.latitud,
                    e.longitud,
                    e.observaciones,
                    DATE_FORMAT(e.fechaEvento, '%Y-%m-%dT%H:%i') AS fechaEvento,
                    seg.codigoSeguimiento,
                    emp.razonSocial AS remitente,
                    CONCAT(v.marca, ' ', v.modelo, ' (', v.placa, ')') AS vehiculo
                  FROM eventos_envio_empresa e
                  JOIN seguimiento_envioempresa seg ON e.idSeguimientoEmpresa = seg.idSeguimientoEmpresa
                  JOIN asignacion_carga_empresa ac ON seg.idAsignacionEmpresa = ac.idAsignacionEmpresa
                  JOIN cotizaciones_empresas cc ON ac.idCotizacionEmpresa = cc.idCotizacionEmpresa
                  JOIN solicitud_empresa s ON cc.idSolicitudempresa = s.idSolicitudempresa
                  JOIN clientes_empresas emp ON s.idEmpresa = emp.idEmpresa
                  JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
                  WHERE e.idEventoEnvio = ?";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idEvento]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($evento) {
        echo json_encode(['success' => true, 'data' => $evento]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Evento no encontrado']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}