<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$sanciones = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$sanciones || empty($sanciones)) {
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

// Obtener logo desde BD
$logoNombre = obtenerLogoDB($conn);
$logoSrc = '';
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
    .badge-warning { background-color: #ffc107; color: #212529; }
    .badge-success { background-color: #28a745; }
    .badge-secondary { background-color: #6c757d; }
    .stats-container { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .stat-box { width: 32%; padding: 10px; background-color: #e9ecef; border-radius: 5px; text-align: center; }
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
                <h2 class="title">SISTEMA DE GESTIÓN DE TRANSPORTE</h2>
                <p class="subtitle">Reporte de Sanciones a Conductores</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE SANCIONES</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalSanciones = count($sanciones);
$sancionesPendientes = 0;
$sancionesProceso = 0;
$sancionesResueltas = 0;
$tiposSancion = [];

foreach ($sanciones as $sancion) {
    switch ($sancion['estado']) {
        case 'Pendiente': $sancionesPendientes++; break;
        case 'En Proceso': $sancionesProceso++; break;
        case 'Resuelta': $sancionesResueltas++; break;
    }
    
    $tipo = $sancion['tipo_sancion'];
    if (!isset($tiposSancion[$tipo])) {
        $tiposSancion[$tipo] = 0;
    }
    $tiposSancion[$tipo]++;
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Sanciones:</strong> ' . $totalSanciones . '
    </div>
    <div class="stat-box">
        <strong>Pendientes:</strong> ' . $sancionesPendientes . '
    </div>
    <div class="stat-box">
        <strong>En Proceso:</strong> ' . $sancionesProceso . '
    </div>
    <div class="stat-box">
        <strong>Resueltas:</strong> ' . $sancionesResueltas . '
    </div>
</div>';

// Tipos de sanción
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">TIPOS DE SANCIÓN</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>Tipo de Sanción</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>';

foreach ($tiposSancion as $tipo => $cantidad) {
    $html .= '<tr>
        <td>' . htmlspecialchars($tipo) . '</td>
        <td class="text-center">' . $cantidad . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Sección del listado de sanciones
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE SANCIONES FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Conductor</th>
            <th>Documento</th>
            <th>Licencia</th>
            <th>Tipo Sanción</th>
            <th>Fecha Registro</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($sanciones as $sancion) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td class="text-center">' . htmlspecialchars($sancion['idSancion']) . '</td>';
    
    // Conductor
    $html .= '<td>' . htmlspecialchars($sancion['conductor']) . '</td>';
    
    // Documento
    $html .= '<td>' . htmlspecialchars($sancion['documento']) . '</td>';
    
    // Licencia
    $html .= '<td>' . htmlspecialchars($sancion['licencia']) . '</td>';
    
    // Tipo Sanción
    $html .= '<td>' . htmlspecialchars($sancion['tipo_sancion']) . '</td>';
    
    // Fecha Registro
    $html .= '<td>' . htmlspecialchars($sancion['fecha_registro']) . '</td>';
    
    // Estado
    $estado = trim($sancion['estado']);
    $badgeClass = match ($estado) {
        'Pendiente' => 'badge-primary',
        'En Proceso' => 'badge-warning',
        'Resuelta' => 'badge-success',
        default => 'badge-secondary'
    };
    $html .= '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $estado . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de transporte.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Sanciones_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>