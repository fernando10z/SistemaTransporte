<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$mantenimientos = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$mantenimientos || empty($mantenimientos)) {
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
    body { font-family: Arial, sans-serif; font-size: 10px; margin: 20px; }
    .header { text-align: center; margin-bottom: 10px; }
    .header img { width: 80px; height: auto; }
    .title { font-size: 16px; font-weight: bold; margin-top: 5px; }
    .subtitle { font-size: 12px; color: #666; margin-bottom: 15px; }
    .report-box { border: 1px solid #666; border-radius: 8px; text-align: center; padding: 10px; display: inline-block; }
    .table-container { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .table-container th { background-color: #5d87ff; color: white; font-weight: bold; text-align: center; padding: 5px; border: 1px solid #ccc; font-size: 9px; }
    .table-container td { padding: 5px; text-align: left; border: 1px solid #ccc; font-size: 9px; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 15px; padding: 10px; font-size: 10px; border: 1px solid #333; border-radius: 8px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 2px 6px; border-radius: 3px; font-size: 9px; font-weight: bold; color: white; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .badge-warning { background-color: #ffc107; color: #212529; }
    .stats-container { display: flex; justify-content: space-between; margin-bottom: 10px; }
    .stat-box { width: 24%; padding: 8px; background-color: #e9ecef; border-radius: 5px; text-align: center; font-size: 10px; }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 80px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <h2 class="title">SISTEMA DE GESTIÓN DE FLOTA</h2>
                <p class="subtitle">Reporte de Mantenimientos de Vehículos</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE MANTENIMIENTOS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalMantenimientos = count($mantenimientos);
$pendientes = 0;
$vencidos = 0;
$realizados = 0;
$preventivos = 0;
$correctivos = 0;
$predictivos = 0;

foreach ($mantenimientos as $mant) {
    switch ($mant['estado']) {
        case 'Pendiente': $pendientes++; break;
        case 'Vencido': $vencidos++; break;
        case 'Realizado': $realizados++; break;
    }
    
    switch ($mant['tipo_mantenimiento']) {
        case 'Preventivo': $preventivos++; break;
        case 'Correctivo': $correctivos++; break;
        case 'Predictivo': $predictivos++; break;
    }
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Mantenimientos:</strong> ' . $totalMantenimientos . '
    </div>
    <div class="stat-box">
        <strong>Pendientes:</strong> ' . $pendientes . '
    </div>
    <div class="stat-box">
        <strong>Vencidos:</strong> ' . $vencidos . '
    </div>
    <div class="stat-box">
        <strong>Realizados:</strong> ' . $realizados . '
    </div>
</div>';

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Preventivos:</strong> ' . $preventivos . '
    </div>
    <div class="stat-box">
        <strong>Correctivos:</strong> ' . $correctivos . '
    </div>
    <div class="stat-box">
        <strong>Predictivos:</strong> ' . $predictivos . '
    </div>
</div>';

// Sección del listado de mantenimientos
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 8px; border-radius: 5px; font-size: 11px;">LISTADO DE MANTENIMIENTOS</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Fecha Mant.</th>
            <th>Próx. Mant.</th>
            <th>Km</th>
            <th>Taller</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($mantenimientos as $mant) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($mant['id']) . '</td>';
    
    // Placa
    $html .= '<td>' . htmlspecialchars($mant['placa']) . '</td>';
    
    // Marca
    $html .= '<td>' . htmlspecialchars($mant['marca']) . '</td>';
    
    // Modelo
    $html .= '<td>' . htmlspecialchars($mant['modelo']) . '</td>';
    
    // Tipo de mantenimiento
    $html .= '<td>' . htmlspecialchars($mant['tipo_mantenimiento']) . '</td>';
    
    // Descripción (limitada a 30 caracteres)
    $descripcion = strlen($mant['descripcion']) > 30 ? substr($mant['descripcion'], 0, 27) . '...' : $mant['descripcion'];
    $html .= '<td>' . htmlspecialchars($descripcion) . '</td>';
    
    // Fecha Mantenimiento
    $html .= '<td>' . htmlspecialchars($mant['fecha_mantenimiento']) . '</td>';
    
    // Próximo Mantenimiento
    $html .= '<td>' . htmlspecialchars($mant['fecha_proxima_mantenimiento']) . '</td>';
    
    // Kilometraje
    $html .= '<td class="text-right">' . htmlspecialchars($mant['kilometraje']) . ' km</td>';
    
    
    // Taller (limitado a 20 caracteres)
    $taller = strlen($mant['taller']) > 20 ? substr($mant['taller'], 0, 17) . '...' : $mant['taller'];
    $html .= '<td>' . htmlspecialchars($taller) . '</td>';
    
    // Estado
    $badgeClass = match ($mant['estado']) {
        'Realizado' => 'badge-success',
        'Vencido' => 'badge-danger',
        default => 'badge-warning'
    };
    $html .= '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $mant['estado'] . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de flota.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Mantenimientos_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>