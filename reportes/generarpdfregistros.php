<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$registros = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$registros || empty($registros)) {
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
    .badge-success { background-color: #28a745; }
    .badge-primary { background-color: #5d87ff; }
    .badge-danger { background-color: #dc3545; }
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
                <h2 class="title">SISTEMA DE GESTIÓN DE CAPACITACIONES</h2>
                <p class="subtitle">Reporte de Registros de Cursos para Conductores</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE REGISTROS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalRegistros = count($registros);
$cursosActivos = 0;
$cursosTerminados = 0;
$cursosNoTerminados = 0;
$conductoresActivos = 0;
$conductoresInactivos = 0;

foreach ($registros as $reg) {
    switch ($reg['estadoCurso']) {
        case 'Activado': $cursosActivos++; break;
        case 'Terminado': $cursosTerminados++; break;
        default: $cursosNoTerminados++; break;
    }
    
    if ($reg['estadoConductor'] === 'Activo') {
        $conductoresActivos++;
    } else {
        $conductoresInactivos++;
    }
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Registros:</strong> ' . $totalRegistros . '
    </div>
    <div class="stat-box">
        <strong>Cursos Activos:</strong> ' . $cursosActivos . '
    </div>
    <div class="stat-box">
        <strong>Cursos Terminados:</strong> ' . $cursosTerminados . '
    </div>
</div>';

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Cursos No Terminados:</strong> ' . $cursosNoTerminados . '
    </div>
    <div class="stat-box">
        <strong>Conductores Activos:</strong> ' . $conductoresActivos . '
    </div>
    <div class="stat-box">
        <strong>Conductores Inactivos:</strong> ' . $conductoresInactivos . '
    </div>
</div>';

// Sección del listado de registros
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE REGISTROS DE CURSOS</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Conductor</th>
            <th>Documento</th>
            <th>Licencia</th>
            <th>Curso</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado Curso</th>
            <th>Estado Conductor</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($registros as $reg) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($reg['idRegistro']) . '</td>';
    
    // Conductor
    $html .= '<td>' . htmlspecialchars($reg['conductor']) . '</td>';
    
    // Documento
    $html .= '<td>' . htmlspecialchars($reg['documento']) . '</td>';
    
    // Licencia
    $html .= '<td>' . htmlspecialchars($reg['licencia']) . '</td>';
    
    // Curso
    $html .= '<td>' . htmlspecialchars($reg['curso']) . '</td>';
    
    // Fecha Inicio
    $html .= '<td>' . htmlspecialchars($reg['fechaInicio']) . '</td>';
    
    // Fecha Fin
    $html .= '<td>' . htmlspecialchars($reg['fechaFin']) . '</td>';
    
    // Estado Curso
    $badgeClassCurso = match ($reg['estadoCurso']) {
        'Activado' => 'badge-success',
        'Terminado' => 'badge-primary',
        default => 'badge-danger'
    };
    $html .= '<td><span class="badge ' . $badgeClassCurso . '">' . $reg['estadoCurso'] . '</span></td>';
    
    // Estado Conductor
    $badgeClassConductor = $reg['estadoConductor'] === 'Activo' ? 'badge-success' : 'badge-danger';
    $html .= '<td><span class="badge ' . $badgeClassConductor . '">' . $reg['estadoConductor'] . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de capacitaciones.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Registros_Cursos_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>