<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $id = $_GET['id'] ?? null;
    $tipo = $_GET['tipo'] ?? null;
    
    if (!$id || !$tipo) {
        throw new Exception("Faltan parámetros requeridos");
    }
    
    if ($tipo === 'Natural') {
        $sql = "SELECT 
                    s.idSolicitud,
                    s.idCliente AS idEntidad,
                    CONCAT(n.nombre, ' ', n.apellidopat, ' ', n.apellidoMat) AS nombreCliente,
                    NULL AS razonSocial,
                    s.tipoCarga,
                    s.peso,
                    s.volumen,
                    s.origen,
                    s.destino,
                    DATE(s.fechaEnvio) AS fechaEnvio,
                    s.descripcion
                FROM solicitudes_clientes s
                JOIN clientes_naturales n ON s.idCliente = n.idCliente
                WHERE s.idSolicitud = :id";
    } else {
        $sql = "SELECT 
                    e.idSolicitudempresa AS idSolicitud,
                    e.idEmpresa AS idEntidad,
                    NULL AS nombreCliente,
                    ce.razonSocial,
                    e.tipo_carga as tipoCarga,
                    e.peso,
                    e.volumen,
                    e.origen,
                    e.destino,
                    DATE(e.fecha_solicitud) AS fechaEnvio,
                    e.observaciones AS descripcion
                FROM solicitud_empresa e
                JOIN clientes_empresas ce ON e.idEmpresa = ce.idEmpresa
                WHERE e.idSolicitudempresa = :id";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($data['tipoCarga'])) {
            $data['tipoCarga'] = ucfirst(strtolower($data['tipoCarga']));
        }
        
        echo json_encode([
            'success' => true,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
    } else {
        throw new Exception("No se encontró la solicitud con ID: $id");
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>