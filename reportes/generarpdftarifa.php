<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$tarifas = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$tarifas || empty($tarifas)) {
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
    .table-container td { padding: 6px; text-align: left; border: 1px solid #ccc; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 13px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .stats-container { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .stat-box { width: 32%; padding: 10px; background-color: #e9ecef; border-radius: 5px; text-align: center; }
    .text-center { text-align: center; }
    .text-end { text-align: right; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 100px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <div class="title">'. $nombreEmpresa .'</div>
                <div class="subtitle">Ruc de la empresa: '. $ruc .'</div>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE TARIFAS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalTarifas = count($tarifas);
$tarifasActivas = 0;
$tarifasInactivas = 0;
$servicios = [];
$zonas = [];

foreach ($tarifas as $tarifa) {
    if ($tarifa['estado'] === 'Activo') {
        $tarifasActivas++;
    } else {
        $tarifasInactivas++;
    }
    
    // Contar por servicio
    $servicio = $tarifa['servicio'];
    if (!isset($servicios[$servicio])) {
        $servicios[$servicio] = 0;
    }
    $servicios[$servicio]++;
    
    // Contar por zona
    $zona = $tarifa['zona'];
    if (!isset($zonas[$zona])) {
        $zonas[$zona] = 0;
    }
    $zonas[$zona]++;
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Tarifas:</strong> ' . $totalTarifas . '
    </div>
    <div class="stat-box">
        <strong>Activas:</strong> ' . $tarifasActivas . '
    </div>
    <div class="stat-box">
        <strong>Inactivas:</strong> ' . $tarifasInactivas . '
    </div>
</div>';

// Distribución por servicio
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">DISTRIBUCIÓN POR SERVICIO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>';

foreach ($servicios as $servicio => $cantidad) {
    $html .= '<tr>
        <td>' . htmlspecialchars($servicio) . '</td>
        <td class="text-center">' . $cantidad . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Sección del listado de tarifas
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE TARIFAS FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Servicio</th>
            <th>Zona</th>
            <th>Monto (S/)</th>
            <th>Observaciones</th>
            <th>Fecha Vigencia</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($tarifas as $tarifa) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td class="text-center">' . htmlspecialchars($tarifa['id']) . '</td>';
    
    // Servicio
    $html .= '<td>' . htmlspecialchars($tarifa['servicio']) . '</td>';
    
    // Zona
    $html .= '<td>' . htmlspecialchars($tarifa['zona']) . '</td>';
    
    // Monto
    $html .= '<td class="text-end">' . htmlspecialchars($tarifa['monto']) . '</td>';
    
    // Observaciones
    $html .= '<td>' . htmlspecialchars($tarifa['observaciones']) . '</td>';
    
    // Fecha Vigencia
    $html .= '<td>' . htmlspecialchars($tarifa['fechaVigencia']) . '</td>';
    
    // Estado
    $badgeClass = $tarifa['estado'] === 'Activo' ? 'badge-success' : 'badge-danger';
    $html .= '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $tarifa['estado'] . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de tarifas.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Tarifas_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>