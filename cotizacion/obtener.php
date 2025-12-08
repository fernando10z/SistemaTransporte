<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$idCotizacion = $_GET['id'] ?? null;
$tipo = $_GET['tipo'] ?? null;

if (!$idCotizacion || !in_array($tipo, ['cliente', 'empresa'])) {
    echo json_encode(['success' => false, 'message' => 'Parámetros inválidos']);
    exit;
}

try {
    if ($tipo === 'cliente') {
        $sql = "SELECT 
                cc.*, 
                CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS nombre_cliente,
                sc.origen, sc.destino, sc.peso AS peso_solicitud, sc.volumen AS volumen_solicitud,
                v.placa, v.marca, v.modelo, v.capacidadPeso, v.capacidadVolumen, v.monto
            FROM cotizaciones_clientes cc
            JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
            JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
            JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
            WHERE cc.idCotizacion = ?";
    } else {
        $sql = "SELECT 
                ce.*, 
                cemp.razonSocial AS nombre_empresa,
                se.origen, se.destino, se.peso AS peso_solicitud, se.volumen AS volumen_solicitud,
                v.placa, v.marca, v.modelo, v.capacidadPeso, v.capacidadVolumen, v.monto
            FROM cotizaciones_empresas ce
            JOIN solicitud_empresa se ON ce.idSolicitudempresa = se.idSolicitudempresa
            JOIN clientes_empresas cemp ON se.idEmpresa = cemp.idEmpresa
            JOIN vehiculos v ON ce.idVehiculo = v.idVehiculo
            WHERE ce.idCotizacionEmpresa = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$idCotizacion]);
    $cotizacion = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cotizacion) {
        echo json_encode(['success' => false, 'message' => 'Cotización no encontrada']);
        exit;
    }

    echo json_encode(['success' => true, 'data' => $cotizacion]);

} catch(PDOException $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'Error al obtener la cotización: ' . $e->getMessage()
    ]);
}
?>