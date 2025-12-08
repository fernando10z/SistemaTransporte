<?php
require('../conexion/conexion.php');

// Recibir parámetros
$tipo = $_GET['tipo'] ?? ''; // 'natural' o 'empresa'
$id = $_GET['id'] ?? 0;

if (!$id || !in_array($tipo, ['natural', 'empresa'])) {
    die('Parámetros inválidos');
}

// Obtener información del cliente/empresa
if ($tipo === 'natural') {
    $stmt = $conn->prepare("
        SELECT cn.*, td.tipoDocumento 
        FROM clientes_naturales cn
        JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
        WHERE cn.idCliente = ?
    ");
} else {
    $stmt = $conn->prepare("
        SELECT ce.*, tr.descripcion AS tipoRuc 
        FROM clientes_empresas ce
        JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
        WHERE ce.idEmpresa = ?
    ");
}
$stmt->execute([$id]);
$infoCliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$infoCliente) {
    die('Cliente/Empresa no encontrado');
}

// Obtener historial de servicios
if ($tipo === 'natural') {
    $stmt = $conn->prepare("
        SELECT 
            cn.idContrato,
            s.nombreServicio AS servicio,
            z.nombreZona AS zona,
            d.fechaServicio,
            d.origen,
            d.destino,
            d.peso,
            d.volumen,
            d.monto,
            cn.estado
        FROM contratos_naturales cn
        JOIN detalle_contrato_natural d ON cn.idContrato = d.idContrato
        JOIN tarifas t ON d.idTarifa = t.idTarifa
        JOIN servicios s ON t.idServicio = s.idServicio
        JOIN zonas_cobertura z ON t.idZona = z.idZona
        WHERE cn.idCliente = ?
        ORDER BY d.fechaServicio DESC
    ");
} else {
    $stmt = $conn->prepare("
        SELECT 
            ce.idContratoempresa AS idContrato,
            d.servicio,
            d.Zona AS zona,
            d.fechaServicio,
            d.origen,
            d.destino,
            d.peso,
            d.volumen,
            d.monto,
            ce.estado
        FROM contratos_empresas ce
        JOIN detalle_contrato_empresa d ON ce.idContratoempresa = d.idContratoempresa
        WHERE ce.idEmpresa = ?
        ORDER BY d.fechaServicio DESC
    ");
}
$stmt->execute([$id]);
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Configurar headers para Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="Historial_Servicios_' . ($tipo === 'natural' ? $infoCliente['nombres'] : $infoCliente['razonSocial']) . '_' . date('Ymd_His') . '.xls"');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');

// Inicio del documento Excel
echo "<!DOCTYPE html>
<html xmlns:o='urn:schemas-microsoft-com:office:office'
      xmlns:x='urn:schemas-microsoft-com:office:excel'
      xmlns='http://www.w3.org/TR/REC-html40'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Historial de Servicios</title>
    <style>
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        th { font-weight: bold; background-color: #f2f2f2; }
        .bg-pendiente { background-color: #ffc107; }
        .bg-enproceso { background-color: #17a2b8; color: white; }
        .bg-completado { background-color: #28a745; color: white; }
        .bg-anulado { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
<table border='1'>
    <tr>
        <th colspan='11' style='background-color: #3a7bd5; color: white; font-size: 16px;'>HISTORIAL DE SERVICIOS</th>
    </tr>
    <tr>
        <th colspan='2'>Cliente/Empresa:</th>
        <td colspan='9'>" . ($tipo === 'natural' ? htmlspecialchars($infoCliente['nombres'] . ' ' . $infoCliente['apePaterno'] . ' ' . $infoCliente['apeMaterno']) : htmlspecialchars($infoCliente['razonSocial'])) . "</td>
    </tr>
    <tr>
        <th colspan='2'>Documento:</th>
        <td colspan='9'>" . ($tipo === 'natural' ? htmlspecialchars($infoCliente['tipoDocumento'] . ' - ' . $infoCliente['numerodocumento']) : htmlspecialchars('RUC ' . $infoCliente['ruc'])) . "</td>
    </tr>
    <tr>
        <th colspan='2'>Total Servicios:</th>
        <td colspan='9'>" . count($servicios) . "</td>
    </tr>
    <tr>
        <th colspan='11' style='background-color: #f2f2f2;'></th>
    </tr>
    <tr>
        <th>#</th>
        <th>Contrato</th>
        <th>Fecha</th>
        <th>Servicio</th>
        <th>Zona</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Peso (kg)</th>
        <th>Volumen (m³)</th>
        <th>Monto (S/)</th>
        <th>Estado</th>
    </tr>";

$totalMonto = 0;
foreach ($servicios as $index => $servicio) {
    $estado = strtolower(str_replace(' ', '', $servicio['estado']));
    
    echo "<tr>
            <td class='text-center'>" . ($index + 1) . "</td>
            <td class='text-center'>" . htmlspecialchars($servicio['idContrato']) . "</td>
            <td class='text-center'>" . htmlspecialchars(date('d/m/Y', strtotime($servicio['fechaServicio']))) . "</td>
            <td class='text-left'>" . htmlspecialchars($servicio['servicio']) . "</td>
            <td class='text-center'>" . htmlspecialchars($servicio['zona']) . "</td>
            <td class='text-left'>" . htmlspecialchars($servicio['origen']) . "</td>
            <td class='text-left'>" . htmlspecialchars($servicio['destino']) . "</td>
            <td class='text-center'>" . ($servicio['peso'] ? htmlspecialchars(number_format($servicio['peso'], 2)) : '-') . "</td>
            <td class='text-center'>" . ($servicio['volumen'] ? htmlspecialchars(number_format($servicio['volumen'], 2)) : '-') . "</td>
            <td class='text-right'>S/ " . htmlspecialchars(number_format($servicio['monto'], 2)) . "</td>
            <td class='text-center bg-{$estado}'>" . htmlspecialchars($servicio['estado']) . "</td>
          </tr>";
    
    $totalMonto += floatval($servicio['monto']);
}

echo "<tr>
        <td colspan='9' class='text-right'><strong>TOTAL:</strong></td>
        <td class='text-right'><strong>S/ " . number_format($totalMonto, 2) . "</strong></td>
        <td></td>
      </tr>";

echo "</table>
<div style='margin-top: 20px; text-align: right; font-style: italic;'>
    Generado el " . date('d/m/Y H:i:s') . "
</div>
</body>
</html>";
exit();
?>