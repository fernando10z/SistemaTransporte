<?php
require_once '../conexion/conexion.php';
require_once '../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

header("Content-Type: application/json");

if (!isset($_POST['idAsignacion']) || !isset($_POST['tipoAsignacion'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

$idAsignacion = $_POST['idAsignacion'];
$tipoAsignacion = $_POST['tipoAsignacion'];

if ($tipoAsignacion == 'cliente') {
    // Obtener datos para cliente natural
    $sql = "SELECT 
                ac.idAsignacion,
                CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS cliente,
                cn.idTipoDocumento,
                cn.numerodocumento,
                v.placa,
                v.modelo,
                sc.tipoCarga,
                sc.peso,
                sc.volumen,
                cc.montoFinal,
                sc.origen,
                sc.destino,
                ac.estado,
                IFNULL(sec.codigoSeguimiento, NULL) AS codigoSeguimiento
            FROM asignacion_carga_cliente ac
            JOIN cotizaciones_clientes cc ON ac.idCotizacion = cc.idCotizacion
            JOIN solicitudes_clientes sc ON cc.idSolicitud = sc.idSolicitud
            JOIN clientes_naturales cn ON sc.idCliente = cn.idCliente
            JOIN vehiculos v ON cc.idVehiculo = v.idVehiculo
            LEFT JOIN seguimiento_envioclientes sec ON ac.idAsignacion = sec.idAsignacion
            WHERE ac.idAsignacion = ?";
} else {
    // Obtener datos para empresa
    $sql = "SELECT 
                ace.idAsignacionEmpresa AS idAsignacion,
                ce.razonSocial AS cliente,
                ce.idTipoRuc,
                ce.ruc,
                v.placa,
                v.modelo,
                se.tipo_carga AS tipoCarga,
                se.peso,
                se.volumen,
                cemp.montoFinal,
                se.origen,
                se.destino,
                ace.estado,
                IFNULL(see.codigoSeguimiento, NULL) AS codigoSeguimiento
            FROM asignacion_carga_empresa ace
            JOIN cotizaciones_empresas cemp ON ace.idCotizacionEmpresa = cemp.idCotizacionEmpresa
            JOIN solicitud_empresa se ON cemp.idSolicitudempresa = se.idSolicitudempresa
            JOIN clientes_empresas ce ON se.idEmpresa = ce.idEmpresa
            JOIN vehiculos v ON cemp.idVehiculo = v.idVehiculo
            LEFT JOIN seguimiento_envioempresa see ON ace.idAsignacionEmpresa = see.idAsignacionEmpresa
            WHERE ace.idAsignacionEmpresa = ?";
}

$stmt = $conn->prepare($sql);
$stmt->execute([$idAsignacion]);
$asignacion = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$asignacion) {
    echo json_encode(["success" => false, "message" => "Asignación no encontrada"]);
    exit;
}

// Generar código de seguimiento único si no existe
if (empty($asignacion['codigoSeguimiento'])) {
    $codigoSeguimiento = strtoupper(uniqid('ENV'));
    
    if ($tipoAsignacion == 'cliente') {
        // Insertar en seguimiento_envioclientes
        $insertSql = "INSERT INTO seguimiento_envioclientes 
                     (idAsignacion, codigoSeguimiento, estadoEnvio) 
                     VALUES (?, ?, ?)";
        $estadoInicial = $asignacion['estado'] == 'Entregado' ? 'Entregado' : 'En tránsito';
    } else {
        // Insertar en seguimiento_envioempresa
        $insertSql = "INSERT INTO seguimiento_envioempresa 
                     (idAsignacionEmpresa, codigoSeguimiento, estadoEnvio) 
                     VALUES (?, ?, ?)";
        $estadoInicial = $asignacion['estado'] == 'Entregado' ? 'Entregado' : 'En tránsito';
    }
    
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->execute([$idAsignacion, $codigoSeguimiento, $estadoInicial]);
} else {
    $codigoSeguimiento = $asignacion['codigoSeguimiento'];
}

// Datos para el QR
$qrData = [
    "codigo_seguimiento" => $codigoSeguimiento,
    "cliente" => $asignacion['cliente'],
    "tipo_documento" => ($tipoAsignacion == 'cliente') ? $asignacion['idTipoDocumento'] : $asignacion['idTipoRuc'],
    "numero_documento" => ($tipoAsignacion == 'cliente') ? $asignacion['numerodocumento'] : $asignacion['ruc'],
    "vehiculo" => $asignacion['placa'] . " - " . $asignacion['modelo'],
    "tipo_carga" => $asignacion['tipoCarga'],
    "peso" => $asignacion['peso'],
    "volumen" => $asignacion['volumen'],
    "monto" => $asignacion['montoFinal'],
    "origen" => $asignacion['origen'],
    "destino" => $asignacion['destino'],
    "estado" => $asignacion['estado']
];

// Generar QR
$qrCode = QrCode::create(json_encode($qrData))
    ->setSize(250)
    ->setMargin(10)
    ->setErrorCorrectionLevel(\Endroid\QrCode\ErrorCorrectionLevel::High);

$writer = new PngWriter();
$result = $writer->write($qrCode);

// Guardar QR
$qrDir = "qrcodes/asignaciones/";
if (!file_exists($qrDir)) {
    mkdir($qrDir, 0777, true);
}

$filename = "asignacion_" . $codigoSeguimiento . ".png";
$filepath = $qrDir . $filename;
file_put_contents($filepath, $result->getString());

echo json_encode([
    "success" => true,
    "qr" => $filepath,
    "codigo_seguimiento" => $codigoSeguimiento,
    "cliente" => $asignacion['cliente'],
    "vehiculo" => $asignacion['placa'] . " - " . $asignacion['modelo'],
    "estado" => $asignacion['estado']
]);
?>