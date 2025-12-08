<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $idEvento = $_GET['id'] ?? null;
    $tipo = $_GET['tipo'] ?? null;
    
    if (!$idEvento || !$tipo) {
        throw new Exception('Faltan parámetros requeridos');
    }
    
    if ($tipo === 'cliente') {
        $query = "SELECT 
                    e.*,
                    CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', IFNULL(cn.apellidoMat, '')) AS clienteInfo,
                    CONCAT(r.origen, ' - ', r.destino) AS ruta,
                    CONCAT(co.nombre, ' ', co.Apepat, ' ', IFNULL(co.Apemat, '')) AS conductor,
                    pr.idPlanificacion
                  FROM eventos_ruta e
                  JOIN planificacion_ruta pr ON e.idPlanificacion = pr.idPlanificacion
                  JOIN asignacion_carga_cliente ac ON pr.idAsignacion = ac.idAsignacion
                  JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
                  JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
                  JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
                  JOIN rutas r ON pr.idRuta = r.idRuta
                  JOIN conductores co ON pr.idConductor = co.idConductor
                  WHERE e.idEvento = ?";
    } else {
        $query = "SELECT 
                    e.*,
                    ce.razonSocial AS empresaInfo,
                    CONCAT(r.origen, ' - ', r.destino) AS ruta,
                    CONCAT(co.nombre, ' ', co.Apepat, ' ', IFNULL(co.Apemat, '')) AS conductor,
                    pre.idPlanificacionempresa 
                  FROM eventos_ruta_empresa e
                  JOIN planificacion_ruta_empresa pre ON e.idPlanificacionempresa = pre.idPlanificacionempresa
                  JOIN asignacion_carga_empresa ace ON pre.idAsignacionEmpresa = ace.idAsignacionEmpresa
                  JOIN cotizaciones_empresas cce ON ace.idCotizacionEmpresa = cce.idCotizacionEmpresa
                  JOIN solicitud_empresa se ON cce.idSolicitudempresa = se.idSolicitudempresa
                  JOIN clientes_empresas ce ON se.idEmpresa = ce.idEmpresa
                  JOIN rutas r ON pre.idRuta = r.idRuta
                  JOIN conductores co ON pre.idConductor = co.idConductor
                  WHERE e.idEvento = ?";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$idEvento]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($evento) {
        // Formatear la fecha para el input datetime-local
        $evento['fechaEvento'] = str_replace(' ', 'T', $evento['fechaEvento']);
        
        $response['success'] = true;
        $response['data'] = $evento;
    } else {
        $response['message'] = 'Evento no encontrado';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>