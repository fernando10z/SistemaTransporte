<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$eventos = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$eventos || empty($eventos)) {
    die("No se recibieron datos para exportar. Por favor aplique filtros y vuelva a intentarlo.");
}

// Obtener la ruta absoluta del logo
$logoPath = __DIR__ . "/../configuracion/empresa/logo_68336f0e8e937.jpeg";

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
    .table-container td { padding: 6px; text-align: left; border: 1px solid #ccc; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 13px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    .badge-primary { background-color: #5d87ff; }
    .badge-info { background-color: #17a2b8; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .badge-secondary { background-color: #6c757d; }
    .badge-light { background-color: #f8f9fa; color: #333; }
    .stats-container { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .stat-box { width: 32%; padding: 10px; background-color: #e9ecef; border-radius: 5px; text-align: center; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 100px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <h2 class="title">SISTEMA DE GESTIÓN LOGÍSTICA</h2>
                <p class="subtitle">Reporte de Eventos de Envío</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE EVENTOS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalEventos = count($eventos);
$eventosClientes = 0;
$eventosEmpresas = 0;
$estados = [
    'Inicio' => 0,
    'En tránsito' => 0,
    'Entregado' => 0,
    'Incidentado' => 0,
    'Cancelado' => 0
];

foreach ($eventos as $evento) {
    if ($evento['tipoEnvios'] === 'Natural') {
        $eventosClientes++;
    } else {
        $eventosEmpresas++;
    }
    
    $estado = trim($evento['estado']);
    if (isset($estados[$estado])) {
        $estados[$estado]++;
    }
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Eventos:</strong> ' . $totalEventos . '
    </div>
    <div class="stat-box">
        <strong>Eventos Clientes:</strong> ' . $eventosClientes . '
    </div>
    <div class="stat-box">
        <strong>Eventos Empresas:</strong> ' . $eventosEmpresas . '
    </div>
</div>';

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Inicio:</strong> ' . $estados['Inicio'] . '
    </div>
    <div class="stat-box">
        <strong>En tránsito:</strong> ' . $estados['En tránsito'] . '
    </div>
    <div class="stat-box">
        <strong>Entregado:</strong> ' . $estados['Entregado'] . '
    </div>
    <div class="stat-box">
        <strong>Incidentado:</strong> ' . $estados['Incidentado'] . '
    </div>
    <div class="stat-box">
        <strong>Cancelado:</strong> ' . $estados['Cancelado'] . '
    </div>
</div>';

// Sección del listado de eventos
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE EVENTOS FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Remitente</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha Evento</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($eventos as $evento) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($evento['idEvento']) . '</td>';
    
    // Tipo
    $html .= '<td>' . htmlspecialchars($evento['tipoEnvios']) . '</td>';
    
    // Remitente
    $html .= '<td>' . htmlspecialchars($evento['remitente']) . '</td>';
    
    // Origen
    $html .= '<td>' . htmlspecialchars($evento['origen']) . '</td>';
    
    // Destino
    $html .= '<td>' . htmlspecialchars($evento['destino']) . '</td>';
    
    // Fecha Evento
    $html .= '<td>' . htmlspecialchars($evento['fechaEvento']) . '</td>';
    
    // Estado
    $estado = trim($evento['estado']);
    $badgeClass = match ($estado) {
        'Inicio'       => 'badge-primary',
        'En tránsito'  => 'badge-info',
        'Entregado'    => 'badge-success',
        'Incidentado'  => 'badge-danger',
        'Cancelado'    => 'badge-secondary',
        default        => 'badge-light'
    };
    $html .= '<td><span class="badge ' . $badgeClass . '">' . $estado . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión logística.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Eventos_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>