<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$cuentas = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$cuentas || empty($cuentas)) {
    die("No se recibieron datos para exportar. Por favor aplique filtros y vuelva a intentarlo.");
}

// Obtener logo desde la base de datos
function obtenerLogoDB($conn) {
    try {
        $sql = "SELECT logo FROM configuracion_empresa WHERE id_configuracion = 4 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['logo'] : null;
    } catch (Exception $e) {
        return null;
    }
}

function obtenernombreempresa($conn) {
    try {
        $sql = "SELECT nombre_empresa FROM configuracion_empresa WHERE id_configuracion = 4 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['nombre_empresa'] : null;
    } catch (Exception $e) {
        return null;
    }
}

function obtenerrucempresa($conn) {
    try {
        $sql = "SELECT ruc FROM configuracion_empresa WHERE id_configuracion = 4 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['ruc'] : null;
    } catch (Exception $e) {
        return null;
    }
}

// Obtener logo desde BD
$logoNombre = obtenerLogoDB($conn);
$logoSrc = '';

//Obtener Ruc desde BD
$ruc = obtenerrucempresa($conn);


//Obtener Nombre de la empresa BD
$nombreEmpresa = obtenernombreempresa($conn);


if ($logoNombre) {
    $logoPath = __DIR__ . "/../configuracion/empresa/" . $logoNombre;
    
    if (file_exists($logoPath)) {
        // Detectar tipo de imagen
        $extension = strtolower(pathinfo($logoNombre, PATHINFO_EXTENSION));
        $mimeType = 'image/jpeg';
        
        switch ($extension) {
            case 'png': $mimeType = 'image/png'; break;
            case 'gif': $mimeType = 'image/gif'; break;
            case 'webp': $mimeType = 'image/webp'; break;
            default: $mimeType = 'image/jpeg';
        }
        
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:' . $mimeType . ';base64,' . $logoBase64;
    }
}

// Logo alternativo si no existe
if (empty($logoSrc)) {
    $logoSrc = 'data:image/svg+xml;base64,' . base64_encode('<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="#5d87ff"/><text x="50%" y="50%" font-size="16" text-anchor="middle" fill="white" dy=".3em">EMPRESA</text></svg>');
}


// Configuración de estilos CSS
$html = '<style>
    body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
    .header { text-align: center; margin-bottom: 10px; }
    .header img { width: 100px; height: auto; }
    .title { font-size: 18px; font-weight: bold; margin-top: 5px; }
    .subtitle { font-size: 13px; color: #666; margin-bottom: 15px; }
    .report-box { border: 1px solid #666; border-radius: 10px; text-align: center; padding: 12px; display: inline-block; }
    .table-container { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .table-container th { background-color: #5d87ff; color: white; font-weight: bold; text-align: center; padding: 6px; border: 1px solid #ccc; }
    .table-container td { padding: 6px; border: 1px solid #ccc; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 13px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    .badge-success { background-color: #28a745; }
    .badge-warning { background-color: #ffc107; color: #212529 !important; }
    .badge-danger { background-color: #dc3545; }
    .text-end { text-align: right; }
    .text-center { text-align: center; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 100px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <h2 class="title">'. $nombreEmpresa .'</h2>
                <p class="subtitle">Ruc de la empresa: '. $ruc .'</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE PAGOS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalCuentas = count($cuentas);
$totalMonto = 0;
$totalPagado = 0;
$totalPendiente = 0;
$estados = [
    'Pagado' => 0,
    'Parcial' => 0,
    'Pendiente' => 0
];

foreach ($cuentas as $cuenta) {
    $totalMonto += floatval($cuenta['monto_total']);
    $totalPagado += floatval($cuenta['monto_pagado']);
    $totalPendiente += floatval($cuenta['monto_final']);
    
    $estado = trim($cuenta['estado']);
    if (isset($estados[$estado])) {
        $estados[$estado]++;
    }
}

$html .= '
<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif; font-weight: bold; margin-top: 15px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <tr>
        <td style="padding: 15px;">

            <!-- Fila 1: Totales y Montos -->
            <table width="100%" cellpadding="0" cellspacing="10">
                <tr>
                    <td width="25%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Total Cuentas</div>
                        <div style="font-size: 14px;">' . $totalCuentas . '</div>
                    </td>

                    <td width="25%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Monto Total</div>
                        <div style="font-size: 14px;">S/ ' . number_format($totalMonto, 2) . '</div>
                    </td>

                    <td width="25%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Monto Pagado</div>
                        <div style="font-size: 14px;">S/ ' . number_format($totalPagado, 2) . '</div>
                    </td>

                    <td width="25%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Monto Pendiente</div>
                        <div style="font-size: 14px;">S/ ' . number_format($totalPendiente, 2) . '</div>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="10" style="margin-top: 5px;">
                <tr>
                    <td width="33%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Pagados</div>
                        <div style="font-size: 14px;">' . $estados['Pagado'] . '</div>
                    </td>

                    <td width="33%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Parciales</div>
                        <div style="font-size: 14px;">' . $estados['Parcial'] . '</div>
                    </td>

                    <td width="33%" align="center" style="background-color: #e9ecef; padding: 10px; border-radius: 5px;">
                        <div style="font-size: 11px; color: #555; margin-bottom: 5px;">Pendientes</div>
                        <div style="font-size: 14px;">' . $estados['Pendiente'] . '</div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>';


// Sección del listado de cuentas por pagar
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE CUENTAS POR PAGAR</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Descripción</th>
            <th class="text-end">Monto Total</th>
            <th class="text-end">Monto Pagado</th>
            <th class="text-end">Monto Final</th>
            <th>Emisión</th>
            <th>Vencimiento</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($cuentas as $cuenta) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($cuenta['idpago']) . '</td>';
    
    // Proveedor
    $html .= '<td>' . htmlspecialchars($cuenta['proveedor']) . '</td>';
    
    // Descripción
    $html .= '<td>' . htmlspecialchars($cuenta['descripcion']) . '</td>';
    
    // Monto Total
    $html .= '<td class="text-end">S/ ' . number_format($cuenta['monto_total'], 2) . '</td>';
    
    // Monto Pagado
    $html .= '<td class="text-end">S/ ' . number_format($cuenta['monto_pagado'], 2) . '</td>';
    
    // Monto Final
    $html .= '<td class="text-end">S/ ' . number_format($cuenta['monto_final'], 2) . '</td>';
    
    // Fecha Emisión
    $html .= '<td>' . htmlspecialchars($cuenta['fecha_emision']) . '</td>';
    
    // Fecha Vencimiento
    $html .= '<td>' . htmlspecialchars($cuenta['fecha_vencimiento']) . '</td>';
    
    // Estado
    $estado = trim($cuenta['estado']);
    $badgeClass = match($estado) {
        'Pagado' => 'badge-success',
        'Parcial' => 'badge-warning',
        'Pendiente' => 'badge-danger',
        default => ''
    };
    $html .= '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $estado . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión.<br>
    Fecha y hora de generación: ' . date('d/m/Y H:i:s') . '<br>
    Este reporte muestra únicamente los datos que cumplen con los filtros aplicados en el sistema.
</div>';

// Configuración de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Descargar el PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Reporte_Cuentas_Pagar_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>