<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php'; 
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$transacciones = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$transacciones || empty($transacciones)) {
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
    .badge-danger { background-color: #dc3545; }
    .badge-secondary { background-color: #6c757d; }
    .text-center { text-align: center; }
    .text-end { text-align: right; }
    .text-muted { color: #6c757d; }
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
                <h4>REPORTE DE TRANSACCIONES</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalTransacciones = count($transacciones);
$ingresos = 0;
$egresos = 0;
$totalIngresos = 0;
$totalEgresos = 0;

foreach ($transacciones as $transaccion) {
    if (strpos($transaccion['tipo'], 'Ingreso') !== false) {
        $ingresos++;
        $monto = (float) str_replace(['S/ ', ','], '', $transaccion['monto']);
        $totalIngresos += $monto;
    } else {
        $egresos++;
        $monto = (float) str_replace(['S/ ', ','], '', $transaccion['monto']);
        $totalEgresos += $monto;
    }
}

$saldo = $totalIngresos - $totalEgresos;

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 20%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Total Transacciones:</strong> ' . $totalTransacciones . '
        </div>
        <div style="width: 15%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Ingresos:</strong> ' . $ingresos . '
        </div>
        <div style="width: 15%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Egresos:</strong> ' . $egresos . '
        </div>
        <div style="width: 20%; text-align: center; padding: 10px; background-color: #d4edda; border-radius: 5px;">
            <strong>Total Ingresos:</strong> S/ ' . number_format($totalIngresos, 2) . '
        </div>
        <div style="width: 20%; text-align: center; padding: 10px; background-color: #f8d7da; border-radius: 5px;">
            <strong>Total Egresos:</strong> S/ ' . number_format($totalEgresos, 2) . '
        </div>
        <div style="width: 20%; text-align: center; padding: 10px; background-color: ' . ($saldo >= 0 ? '#d4edda' : '#f8d7da') . '; border-radius: 5px;">
            <strong>Saldo:</strong> S/ ' . number_format($saldo, 2) . '
        </div>
    </div>
</div>';

// Sección del listado de transacciones
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE TRANSACCIONES FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Servicio</th>
            <th>Concepto</th>
            <th class="text-end">Monto</th>
            <th>Fecha</th>
            <th>Método Pago</th>
            <th>Observación</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($transacciones as $transaccion) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($transaccion['id']) . '</td>';
    
    // Tipo
    $badgeClass = strpos($transaccion['tipo'], 'Ingreso') !== false ? 'success' : 'danger';
    $html .= '<td class="text-center"><span class="badge badge-' . $badgeClass . '">' . htmlspecialchars($transaccion['tipo']) . '</span></td>';
    
    // Servicio
    $html .= '<td>' . (empty($transaccion['servicio']) ? '<em class="text-muted">Sin servicio</em>' : htmlspecialchars($transaccion['servicio'])) . '</td>';
    
    // Concepto
    $html .= '<td>' . htmlspecialchars($transaccion['concepto']) . '</td>';
    
    // Monto
    $html .= '<td class="text-end">' . htmlspecialchars($transaccion['monto']) . '</td>';
    
    // Fecha
    $html .= '<td>' . htmlspecialchars($transaccion['fecha']) . '</td>';
    
    // Método Pago
    $html .= '<td>' . htmlspecialchars($transaccion['metodo_pago']) . '</td>';
    
    $html .= '<td>' . htmlspecialchars($transaccion['observacion']) . '</td>';

    // Estado
    $badgeClass = strpos($transaccion['estado'], 'Activo') !== false ? 'success' : 'danger';
    $html .= '<td class="text-center"><span class="badge badge-' . $badgeClass . '">' . htmlspecialchars($transaccion['estado']) . '</span></td>';
    
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
header('Content-Disposition: attachment; filename="Reporte_Transacciones_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>