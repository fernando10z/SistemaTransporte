<?php
require '../conexion/conexion.php';

$id = $_POST['id'];
$tipo = $_POST['tipo'];

try {
    if($tipo === 'cliente') {
        $query = "SELECT 
                    ac.idAsignacion,
                    ac.idCotizacion,
                    CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS cliente,
                    v.placa AS vehiculo_placa,
                    v.modelo AS vehiculo_modelo,
                    sc.peso,
                    sc.volumen,
                    ac.observaciones,
                    ac.estado
                FROM asignacion_carga_cliente ac
                JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
                JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
                JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
                JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
                WHERE ac.idAsignacion = :id";
    } else {
        $query = "SELECT 
                    ace.idAsignacionEmpresa AS idAsignacion,
                    ace.idCotizacionEmpresa AS idCotizacion,
                    ce2.razonSocial AS cliente,
                    v.placa AS vehiculo_placa,
                    v.modelo AS vehiculo_modelo,
                    se.peso,
                    se.volumen,
                    ace.observaciones,
                    ace.estado
                FROM asignacion_carga_empresa ace
                JOIN cotizaciones_empresas ce ON ace.idCotizacionEmpresa = ce.idCotizacionEmpresa
                JOIN solicitud_empresa se ON ce.idSolicitudempresa = se.idSolicitudempresa
                JOIN clientes_empresas ce2 ON se.idEmpresa = ce2.idEmpresa
                JOIN vehiculos v ON ce.idVehiculo = v.idVehiculo
                WHERE ace.idAsignacionEmpresa = :id";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    if($stmt->rowCount() > 0) {
        $asignacion = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode([
            'success' => true,
            'idAsignacion' => $asignacion['idAsignacion'],
            'idCotizacion' => $asignacion['idCotizacion'],
            'cliente' => $asignacion['cliente'],
            'vehiculo_placa' => $asignacion['vehiculo_placa'],
            'vehiculo_modelo' => $asignacion['vehiculo_modelo'],
            'peso' => $asignacion['peso'],
            'volumen' => $asignacion['volumen'],
            'observaciones' => $asignacion['observaciones'],
            'estado' => $asignacion['estado']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró la asignación'
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener los datos: ' . $e->getMessage()
    ]);
}
?>