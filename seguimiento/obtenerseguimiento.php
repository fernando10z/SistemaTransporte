<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$idAsignacion = $_POST['idAsignacion'] ?? null;
$tipoAsignacion = $_POST['tipoAsignacion'] ?? null;
$codigoSeguimiento = $_POST['codigoSeguimiento'] ?? null;

try {
    if ($codigoSeguimiento) {
        $sql = "SELECT 
                    sec.idSeguimiento AS idSeguimiento,
                    sec.codigoSeguimiento,
                    sec.estadoEnvio,
                    COALESCE(
                        (SELECT MAX(fechaEvento) 
                         FROM eventos_envio_clientes 
                         WHERE idSeguimiento = sec.idSeguimiento),
                        sec.ultimaActualizacion
                    ) AS ultimaActualizacion,
                    ac.idAsignacion,
                    'cliente' as tipoAsignacion,
                    CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) as cliente,
                    v.placa, 
                    v.modelo,
                    sc.origen,
                    sc.destino
                FROM seguimiento_envioclientes sec
                JOIN asignacion_carga_cliente ac ON sec.idAsignacion = ac.idAsignacion
                JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
                JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
                JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
                JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
                WHERE sec.codigoSeguimiento = ?
                
                UNION ALL
                
                SELECT 
                    see.idSeguimientoEmpresa AS idSeguimiento,
                    see.codigoSeguimiento,
                    see.estadoEnvio,
                    COALESCE(
                        (SELECT MAX(fechaEvento) 
                         FROM eventos_envio_empresa 
                         WHERE idSeguimientoEmpresa = see.idSeguimientoEmpresa),
                        see.ultimaActualizacion
                    ) AS ultimaActualizacion,
                    ace.idAsignacionEmpresa as idAsignacion,
                    'empresa' as tipoAsignacion,
                    ce2.razonSocial as cliente,
                    v.placa,
                    v.modelo,
                    se.origen,
                    se.destino
                FROM seguimiento_envioempresa see
                JOIN asignacion_carga_empresa ace ON see.idAsignacionEmpresa = ace.idAsignacionEmpresa
                JOIN cotizaciones_empresas ce ON ace.idCotizacionEmpresa = ce.idCotizacionEmpresa
                JOIN solicitud_empresa se ON ce.idSolicitudempresa = se.idSolicitudempresa
                JOIN clientes_empresas ce2 ON se.idEmpresa = ce2.idEmpresa
                JOIN vehiculos v ON ce.idVehiculo = v.idVehiculo
                WHERE see.codigoSeguimiento = ?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$codigoSeguimiento, $codigoSeguimiento]);
    } elseif ($idAsignacion && $tipoAsignacion) {
        if ($tipoAsignacion === 'cliente') {
            $sql = "SELECT 
                        sec.idSeguimiento AS idSeguimiento,
                        sec.codigoSeguimiento,
                        sec.estadoEnvio,
                        COALESCE(
                            (SELECT MAX(fechaEvento) 
                             FROM eventos_envio_clientes 
                             WHERE idSeguimiento = sec.idSeguimiento),
                            sec.ultimaActualizacion
                        ) AS ultimaActualizacion,
                        ac.idAsignacion,
                        'cliente' as tipoAsignacion,
                        CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) as cliente,
                        v.placa, 
                        v.modelo,
                        sc.origen,
                        sc.destino
                    FROM seguimiento_envioclientes sec
                    JOIN asignacion_carga_cliente ac ON sec.idAsignacion = ac.idAsignacion
                    JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
                    JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
                    JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
                    JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
                    WHERE sec.idAsignacion = ?";
        } else {
            $sql = "SELECT 
                        see.idSeguimientoEmpresa AS idSeguimiento,
                        see.codigoSeguimiento,
                        see.estadoEnvio,
                        COALESCE(
                            (SELECT MAX(fechaEvento) 
                             FROM eventos_envio_empresa 
                             WHERE idSeguimientoEmpresa = see.idSeguimientoEmpresa),
                            see.ultimaActualizacion
                        ) AS ultimaActualizacion,
                        ace.idAsignacionEmpresa as idAsignacion,
                        'empresa' as tipoAsignacion,
                        ce2.razonSocial as cliente,
                        v.placa,
                        v.modelo,
                        se.origen,
                        se.destino
                    FROM seguimiento_envioempresa see
                    JOIN asignacion_carga_empresa ace ON see.idAsignacionEmpresa = ace.idAsignacionEmpresa
                    JOIN cotizaciones_empresas ce ON ace.idCotizacionEmpresa = ce.idCotizacionEmpresa
                    JOIN solicitud_empresa se ON ce.idSolicitudempresa = se.idSolicitudempresa
                    JOIN clientes_empresas ce2 ON se.idEmpresa = ce2.idEmpresa
                    JOIN vehiculos v ON ce.idVehiculo = v.idVehiculo
                    WHERE see.idAsignacionEmpresa = ?";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute([$idAsignacion]);
    } else {
        throw new Exception("Parámetros insuficientes para la búsqueda.");
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result && count($result) > 0) {
        // Formatear la fecha para mostrarla mejor
        foreach ($result as &$row) {
            if ($row['ultimaActualizacion']) {
                $date = new DateTime($row['ultimaActualizacion']);
                $row['ultimaActualizacion'] = $date->format('d/m/Y H:i:s');
            }
        }
        
        echo json_encode([
            'success' => true,
            'data' => $result
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'No se encontró información de seguimiento con los parámetros proporcionados.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>