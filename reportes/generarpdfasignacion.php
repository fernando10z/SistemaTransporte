<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php'; // Ajusta la ruta a tu archivo de conexión

use Dompdf\Dompdf;
use Dompdf\Options;

date_default_timezone_set('America/Lima');

// Función para limpiar HTML y obtener solo texto
function limpiarHTML($texto) {
    if (empty($texto)) return '';
    // Eliminar etiquetas HTML y decodificar entidades
    $limpio = strip_tags($texto);
    $limpio = html_entity_decode($limpio, ENT_QUOTES, 'UTF-8');
    return trim($limpio);
}

// Obtener los datos filtrados desde el formulario POST
$asignaciones = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

if (!$asignaciones || empty($asignaciones)) {
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
    body { font-family: Arial, sans-serif; font-size: 11px; margin: 20px; }
    .header { text-align: center; margin-bottom: 10px; }
    .title { font-size: 18px; font-weight: bold; margin-top: 5px; }
    .subtitle { font-size: 13px; color: #666; margin-bottom: 15px; }
    .report-box { border: 1px solid #666; border-radius: 10px; text-align: center; padding: 12px; }
    .table-container { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .table-container th { background-color: #5d87ff; color: white; font-weight: bold; text-align: center; padding: 6px; border: 1px solid #ccc; font-size: 10px; }
    .table-container td { padding: 5px; border: 1px solid #ccc; font-size: 10px; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 11px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 9px; font-weight: bold; color: white; display: inline-block; }
    .badge-warning { background-color: #ffc107; color: #000; }
    .badge-info { background-color: #17a2b8; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .badge-secondary { background-color: #6c757d; }
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .resumen-box { background-color: #f8f9fa; border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-top: 15px; }
    .resumen-item { display: inline-block; width: 18%; text-align: center; padding: 8px; background-color: #e9ecef; border-radius: 5px; margin: 0 1%; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left; vertical-align: middle;">
            <img src="' . $logoSrc . '" style="width: 90px; height: auto;">
        </td>
        <td width="60%" style="text-align: center; vertical-align: middle;">
            <div class="header">
                <div class="title">'. $nombreEmpresa .'</div>
                <div class="subtitle">Ruc de la empresa: '. $ruc .'</div>
            </div>
        </td>
        <td width="20%" style="text-align: right; vertical-align: middle;">
            <div class="report-box">
                <strong>REPORTE DE ASIGNACIONES </strong><br>
                <strong>' . date('d/m/Y') . '</strong>
            </div>
        </td>
    </tr>
</table>';

// Calcular estadísticas (limpiando HTML primero)
$totalAsignaciones = count($asignaciones);
$asignacionesNaturales = 0;
$asignacionesEmpresas = 0;
$pendientes = 0;
$enTransito = 0;
$entregadas = 0;
$canceladas = 0;
$totalCosto = 0;

foreach ($asignaciones as $asignacion) {
    $tipo = limpiarHTML($asignacion[1]);
    if ($tipo == 'Natural') {
        $asignacionesNaturales++;
    } else {
        $asignacionesEmpresas++;
    }
    
    // El estado está en el índice 11 (último)
    $estado = limpiarHTML($asignacion[11]);
    switch ($estado) {
        case 'Pendiente': $pendientes++; break;
        case 'En tránsito': $enTransito++; break;
        case 'Entregado': $entregadas++; break;
        case 'Cancelado': $canceladas++; break;
    }
    
    // Costo está en índice 9
    $costo = preg_replace('/[^0-9.]/', '', limpiarHTML($asignacion[9]));
    $totalCosto += floatval($costo);
}

// Resumen estadístico
$html .= '<table class="resumen-box" width="100%">
    <tr>
        <td width="20%" style="text-align: center; background-color: #e9ecef; padding: 8px; border-radius: 5px;">
            <strong>Total:</strong> ' . $totalAsignaciones . '
        </td>
        <td width="20%" style="text-align: center; background-color: #e9ecef; padding: 8px; border-radius: 5px;">
            <strong>Naturales:</strong> ' . $asignacionesNaturales . '
        </td>
        <td width="20%" style="text-align: center; background-color: #e9ecef; padding: 8px; border-radius: 5px;">
            <strong>Empresas:</strong> ' . $asignacionesEmpresas . '
        </td>
        <td width="20%" style="text-align: center; background-color: #e9ecef; padding: 8px; border-radius: 5px;">
            <strong>Costo:</strong> S/ ' . number_format($totalCosto, 2) . '
        </td>
    </tr>
</table>';

// Título de la sección
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE ASIGNACIONES FILTRADO</div>';

// Tabla de datos
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Peso (kg)</th>
            <th>Volumen (m³)</th>
            <th>Código Seg.</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

foreach ($asignaciones as $asignacion) {
    // Limpiar TODOS los campos de HTML
    $id = limpiarHTML($asignacion[0]);
    $tipo = limpiarHTML($asignacion[1]);
    $cliente = limpiarHTML($asignacion[2]);
    $vehiculoPlaca = limpiarHTML($asignacion[3]);
    $vehiculoModelo = limpiarHTML($asignacion[4]);
    $origen = limpiarHTML($asignacion[5]);
    $destino = limpiarHTML($asignacion[6]);
    $peso = limpiarHTML($asignacion[7]);
    $volumen = limpiarHTML($asignacion[8]);
    $costo = limpiarHTML($asignacion[9]);
    $codigoSeg = limpiarHTML($asignacion[10]);

    // Determinar clase del badge según estado
    $badgeClass = 'secondary';
    switch ($estado) {
        case 'Pendiente': $badgeClass = 'warning'; break;
        case 'En tránsito': $badgeClass = 'info'; break;
        case 'Entregado': $badgeClass = 'success'; break;
        case 'Cancelado': $badgeClass = 'danger'; break;
    }
    
    $html .= '<tr>
        <td class="text-center">' . htmlspecialchars($id) . '</td>
        <td>' . htmlspecialchars($tipo) . '</td>
        <td>' . htmlspecialchars($cliente) . '</td>
        <td>' . htmlspecialchars($vehiculoPlaca . ' - ' . $vehiculoModelo) . '</td>
        <td>' . htmlspecialchars($origen) . '</td>
        <td>' . htmlspecialchars($destino) . '</td>
        <td class="text-right">' . htmlspecialchars($peso) . '</td>
        <td class="text-right">' . htmlspecialchars($volumen) . '</td>
        <td class="text-right">' . htmlspecialchars($costo) . '</td>
        <td class="text-center">' . htmlspecialchars($codigoSeg) . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el Sistema de Gestión de Transporte<br>
    Fecha y hora: ' . date('d/m/Y H:i:s') . '<br>
    <small>Este reporte muestra únicamente los datos filtrados en el sistema.</small>
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

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Reporte_Asignaciones_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;