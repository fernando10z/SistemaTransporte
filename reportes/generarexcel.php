<?php
require('../conexion/conexion.php');

// Verificar parámetros
if (!isset($_GET['tipo']) || !isset($_GET['id'])) {
    die("Parámetros incompletos");
}

$tipo = $_GET['tipo']; // 'natural' o 'empresa'
$id = $_GET['id'];

// Obtener información del cliente/empresa
if ($tipo === 'natural') {
    $sql_info = "SELECT 
                cn.*, 
                td.tipoDocumento 
            FROM clientes_naturales cn
            JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
            WHERE cn.idCliente = ?";
} else {
    $sql_info = "SELECT 
                ce.*, 
                tr.descripcion AS tipoRuc 
            FROM clientes_empresas ce
            JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
            WHERE ce.idEmpresa = ?";
}

$stmt_info = $conn->prepare($sql_info);
$stmt_info->execute([$id]);
$info = $stmt_info->fetch(PDO::FETCH_ASSOC);

// Obtener historial de servicios
if ($tipo === 'natural') {
    $sql_historial = "SELECT 
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
                ORDER BY d.fechaServicio DESC";
} else {
    $sql_historial = "SELECT 
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
                ORDER BY d.fechaServicio DESC";
}

$stmt_historial = $conn->prepare($sql_historial);
$stmt_historial->execute([$id]);
$historial = $stmt_historial->fetchAll(PDO::FETCH_ASSOC);

// Configurar headers para Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="reporte_contratos_'.($tipo === 'natural' ? $info['numerodocumento'] : $info['ruc']).'_'.date('Ymd_His').'.xls"');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');

// Inicio del documento Excel
echo "<!DOCTYPE html>
<html xmlns:o='urn:schemas-microsoft-com:office:office'
      xmlns:x='urn:schemas-microsoft-com:office:excel'
      xmlns='http://www.w3.org/TR/REC-html40'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Reporte de Contratos</title>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Servicios</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                        <x:FreezePanes/>
                        <x:FrozenNoSplit/>
                        <x:SplitHorizontal>1</x:SplitHorizontal>
                        <x:TopRowBottomPane>1</x:TopRowBottomPane>
                        <x:ActivePane>2</x:ActivePane>
                        <x:ProtectContents>False</x:ProtectContents>
                        <x:ProtectObjects>False</x:ProtectObjects>
                        <x:ProtectScenarios>False</x:ProtectScenarios>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
    <style>
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .bg-pendiente { background-color: #ffc107; color: #212529; }
        .bg-enproceso { background-color: #17a2b8; color: white; }
        .bg-completado { background-color: #28a745; color: white; }
        .bg-anulado { background-color: #dc3545; color: white; }
        th { font-weight: bold; background-color: #f2f2f2; }
        td { mso-number-format:\\@; } /* Fuerza formato de texto */
    </style>
</head>
<body>
<table border='1'>
    <tr>
        <th colspan='10' style='background-color: #3a7bd5; color: white; font-size: 16px;'>REPORTE DE CONTRATOS - ".($tipo === 'natural' ? 'CLIENTE NATURAL' : 'EMPRESA')."</th>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>".($tipo === 'natural' ? 'Nombre:' : 'Razón Social:')."</th>
        <td colspan='8'>".htmlspecialchars($tipo === 'natural' ? $info['nombre'].' '.$info['apellidopat'].' '.$info['apellidoMat'] : $info['razonSocial'])."</td>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>".($tipo === 'natural' ? 'Documento:' : 'RUC:')."</th>
        <td colspan='8'>".htmlspecialchars($tipo === 'natural' ? $info['tipoDocumento'].' - '.$info['numerodocumento'] : $info['ruc'].' ('.$info['tipoRuc'].')')."</td>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>Teléfono:</th>
        <td colspan='8'>".htmlspecialchars($info['telefono'] ?? 'No registrado')."</td>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>Correo:</th>
        <td colspan='8'>".htmlspecialchars($info['correo'] ?? 'No registrado')."</td>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>Dirección:</th>
        <td colspan='8'>".htmlspecialchars($info['direccion'] ?? 'No registrada')."</td>
    </tr>
    <tr>
        <th colspan='2' style='text-align: left;'>Total Servicios:</th>
        <td colspan='8'>".count($historial)."</td>
    </tr>
    <tr>
        <th colspan='10' style='background-color: #f2f2f2;'></th>
    </tr>
    <tr>
        <th># Contrato</th>
        <th>Fecha Servicio</th>
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
foreach ($historial as $row) {
    $totalMonto += floatval($row['monto']);
    
    // Mapear estado a clase CSS
    $estado = strtolower(str_replace(' ', '', $row['estado']));
    
    echo "<tr>
            <td class='text-center'>".htmlspecialchars($row['idContrato'])."</td>
            <td class='text-center'>".htmlspecialchars($row['fechaServicio'])."</td>
            <td class='text-left'>".htmlspecialchars($row['servicio'])."</td>
            <td class='text-left'>".htmlspecialchars($row['zona'])."</td>
            <td class='text-left'>".htmlspecialchars($row['origen'])."</td>
            <td class='text-left'>".htmlspecialchars($row['destino'])."</td>
            <td class='text-center'>".($row['peso'] ? number_format($row['peso'], 2) : '-')."</td>
            <td class='text-center'>".($row['volumen'] ? number_format($row['volumen'], 2) : '-')."</td>
            <td class='text-right'>S/".number_format($row['monto'], 2)."</td>
            <td class='text-center bg-{$estado}'>".htmlspecialchars($row['estado'])."</td>
          </tr>";
}

// Total
echo "<tr>
        <td colspan='8' class='text-right fw-bold'>TOTAL:</td>
        <td class='text-right fw-bold'>S/".number_format($totalMonto, 2)."</td>
        <td></td>
      </tr>";

echo "</table>
</body>
</html>";
exit();
?>