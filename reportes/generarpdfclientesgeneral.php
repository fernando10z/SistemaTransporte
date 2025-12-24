<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$clientes = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$clientes || empty($clientes)) {
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
    .table-container td { padding: 6px; text-align: center; border: 1px solid #ccc; }
    .table-container tr:nth-child(even) { background-color: #f9f9f9; }
    .pie-pagina { margin-top: 20px; padding: 12px; font-size: 13px; border: 1px solid #333; border-radius: 10px; text-align: center; background-color: #f8f9fa; }
    .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
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
                <p class="subtitle">Reporte de Clientes</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE CLIENTES</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalClientes = count($clientes);
$clientesNaturales = 0;
$clientesEmpresas = 0;
$clientesActivos = 0;
$clientesInactivos = 0;

foreach ($clientes as $cliente) {
    if ($cliente[1] == 'Natural') {
        $clientesNaturales++;
    } else {
        $clientesEmpresas++;
    }
    
    if (strpos($cliente[7], 'Activo') !== false) {
        $clientesActivos++;
    } else {
        $clientesInactivos++;
    }
}

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Total Clientes:</strong> ' . $totalClientes . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Clientes Naturales:</strong> ' . $clientesNaturales . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Clientes Empresas:</strong> ' . $clientesEmpresas . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Activos/Inactivos:</strong> ' . $clientesActivos . '/' . $clientesInactivos . '
        </div>
    </div>
</div>';

// Sección del listado de clientes
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE CLIENTES FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre/Razón Social</th>
            <th>Tipo Doc/Ruc</th>
            <th>Número Doc.</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($clientes as $cliente) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . strip_tags($cliente[0]) . '</td>';
    
    // Tipo
    $html .= '<td>' . strip_tags($cliente[1]) . '</td>';
    
    // Nombre/Razón Social
    $html .= '<td>' . strip_tags($cliente[2]) . '</td>';
    
    // Tipo Doc/Ruc
    $html .= '<td>' . strip_tags($cliente[3]) . '</td>';
    
    // Número Doc
    $html .= '<td>' . strip_tags($cliente[4]) . '</td>';
    
    // Teléfono
    $html .= '<td>' . strip_tags($cliente[5]) . '</td>';
    
    // Correo
    $html .= '<td>' . strip_tags($cliente[6]) . '</td>';
    
    // Estado
    $estado = $cliente[7];
    if (strpos($estado, 'Activo') !== false) {
        $html .= '<td><span class="badge badge-success">Activo</span></td>';
    } else {
        $html .= '<td><span class="badge badge-danger">Inactivo</span></td>';
    }
    
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
header('Content-Disposition: attachment; filename="Reporte_Clientes_Filtrado.pdf"');
echo $dompdf->output();
exit;
?>