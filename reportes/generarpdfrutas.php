<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$rutas = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$rutas || empty($rutas)) {
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
    .table-container td { padding: 6px; border: 1px solid #ccc; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 13px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
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
                <h2 class="title">SISTEMA DE GESTIÓN</h2>
                <p class="subtitle">Reporte de Rutas</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE RUTAS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalRutas = count($rutas);
$rutasActivas = 0;
$rutasInactivas = 0;

foreach ($rutas as $ruta) {
    if (strpos($ruta['estado'], 'Activado') !== false) {
        $rutasActivas++;
    } else {
        $rutasInactivas++;
    }
}

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 32%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Total Rutas:</strong> ' . $totalRutas . '
        </div>
        <div style="width: 32%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Rutas Activas:</strong> ' . $rutasActivas . '
        </div>
        <div style="width: 32%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Rutas Inactivas:</strong> ' . $rutasInactivas . '
        </div>
    </div>
</div>';

// Sección del listado de rutas
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE RUTAS FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Zona</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Distancia (km)</th>
            <th>Tiempo Estimado</th>
            <th>Descripción</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($rutas as $ruta) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($ruta['id']) . '</td>';
    
    // Zona
    $html .= '<td>' . htmlspecialchars($ruta['zona']) . '</td>';
    
    // Origen
    $html .= '<td>' . htmlspecialchars($ruta['origen']) . '</td>';
    
    // Destino
    $html .= '<td>' . htmlspecialchars($ruta['destino']) . '</td>';
    
    // Distancia
    $html .= '<td>' . htmlspecialchars($ruta['distancia']) . '</td>';
    
    // Tiempo Estimado
    $html .= '<td>' . htmlspecialchars($ruta['tiempo']) . '</td>';
    
    // Descripción
    $html .= '<td>' . htmlspecialchars($ruta['descripcion']) . '</td>';
    
    // Estado
    $estado = trim($ruta['estado']);
    $badgeClass = strpos($estado, 'Activado') !== false ? 'badge-success' : 'badge-danger';
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
header('Content-Disposition: attachment; filename="Reporte_Rutas_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>