<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$solicitudes = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$solicitudes || empty($solicitudes)) {
    die("No se recibieron datos para exportar. Por favor aplique filtros y vuelva a intentarlo.");
}

// Obtener la ruta absoluta del logo
$logoPath = __DIR__ . "/../configuracion/empresa/logo_683f42f234013.jpeg";

// Verificar si el logo existe
if (!file_exists($logoPath)) {
    // Logo alternativo si no existe
    $logoSrc = 'data:image/svg+xml;base64,' . base64_encode('<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="#5d87ff"/><text x="50%" y="50%" font-size="20" text-anchor="middle" fill="white" dy=".3em">EMPRESA</text></svg>');
} else {
    // Convertir la ruta local a base64 para que Dompdf lo pueda procesar
    $logoBase64 = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/jpeg;base64,' . $logoBase64;
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
    .badge-warning { background-color: #ffc107; }
    .badge-info { background-color: #17a2b8; }
    .badge-primary { background-color: #007bff; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .badge-secondary { background-color: #6c757d; }
    .text-center { text-align: center; }
    .text-end { text-align: right; }
    .fa { font-family: FontAwesome; }
    .icon-user { color: #007bff; }
    .icon-building { color: #17a2b8; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 100px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <h2 class="title">SISTEMA DE GESTIÓN</h2>
                <p class="subtitle">Reporte de Solicitudes</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE SOLICITUDES</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalSolicitudes = count($solicitudes);
$estadosCount = [
    'Pendiente' => 0,
    'Cotizado' => 0,
    'Asignado' => 0,
    'Entregado' => 0,
    'Anulado' => 0
];

$tiposCount = [
    'Natural' => 0,
    'Empresa' => 0
];

foreach ($solicitudes as $solicitud) {
    // Contar por estado
    $estado = trim(ucfirst(strtolower($solicitud['estado'])));
    if (isset($estadosCount[$estado])) {
        $estadosCount[$estado]++;
    }
    
    // Contar por tipo de cliente
    $tipoCliente = trim($solicitud['tipo_cliente']);
    if (isset($tiposCount[$tipoCliente])) {
        $tiposCount[$tipoCliente]++;
    }
}

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
        <div style="width: 20%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Total Solicitudes:</strong> ' . $totalSolicitudes . '
        </div>';

foreach ($estadosCount as $estado => $count) {
    $badgeClass = strtolower($estado);
    $html .= '<div style="width: 15%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
                <strong>' . $estado . ':</strong> ' . $count . '
              </div>';
}

$html .= '</div>';

$html .= '<div style="display: flex; justify-content: space-between;">
    <div style="width: 48%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
        <strong>Clientes Naturales:</strong> ' . $tiposCount['Natural'] . '
    </div>
    <div style="width: 48%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
        <strong>Clientes Empresa:</strong> ' . $tiposCount['Empresa'] . '
    </div>
</div>';

$html .= '</div>';

// Sección del listado de solicitudes
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE SOLICITUDES FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo Cliente</th>
            <th>Cliente</th>
            <th>Tipo Carga</th>
            <th class="text-end">Peso (kg)</th>
            <th class="text-end">Volumen (m³)</th>
            <th>Origen</th>
            <th>Destino</th>
            <th class="text-center">Estado</th>
            <th>Fecha Registro</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($solicitudes as $solicitud) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($solicitud['id']) . '</td>';
    
    // Tipo Cliente con icono
    $tipoCliente = trim($solicitud['tipo_cliente']);
    if ($tipoCliente === 'Natural') {
        $html .= '<td><span class="icon-user">●</span> Natural</td>';
    } else {
        $html .= '<td><span class="icon-building">●</span> Empresa</td>';
    }
    
    // Cliente
    $html .= '<td>' . htmlspecialchars($solicitud['cliente']) . '</td>';
    
    // Tipo Carga
    $html .= '<td>' . htmlspecialchars($solicitud['tipo_carga']) . '</td>';
    
    // Peso
    $html .= '<td class="text-end">' . htmlspecialchars($solicitud['peso']) . '</td>';
    
    // Volumen
    $html .= '<td class="text-end">' . htmlspecialchars($solicitud['volumen']) . '</td>';
    
    // Origen
    $html .= '<td>' . htmlspecialchars($solicitud['origen']) . '</td>';
    
    // Destino
    $html .= '<td>' . htmlspecialchars($solicitud['destino']) . '</td>';
    
    // Estado con badge
    $estado = trim(ucfirst(strtolower($solicitud['estado'])));
    $badgeConfig = [
        'Pendiente' => 'warning',
        'Cotizado' => 'info',
        'Asignado' => 'primary',
        'Entregado' => 'success',
        'Anulado' => 'danger'
    ];
    
    $badgeClass = $badgeConfig[$estado] ?? 'secondary';
    $html .= '<td class="text-center"><span class="badge badge-' . $badgeClass . '">' . $estado . '</span></td>';
    
    // Fecha Registro
    $html .= '<td>' . htmlspecialchars($solicitud['fecha']) . '</td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión.<br>
    Fecha y hora de generación: ' . date('d/m/Y H:i:s') . '<br>
    Este reporte muestra ' . $totalSolicitudes . ' solicitudes que cumplen con los filtros aplicados.
</div>';

// Configuración de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Descargar el PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Reporte_Solicitudes_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>