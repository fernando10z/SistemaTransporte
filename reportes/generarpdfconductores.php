<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$conductores = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$conductores || empty($conductores)) {
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
    .badge-secondary { background-color: #6c757d; }
    .text-right { text-align: right; }
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
                <h2 class="title">GESTIÓN DE CONDUCTORES</h2>
                <p class="subtitle">Reporte de Conductores Registrados</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE CONDUCTORES</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalConductores = count($conductores);
$activos = 0;
$inactivos = 0;
$masculinos = 0;
$femeninos = 0;

foreach ($conductores as $conductor) {
    if (strpos($conductor[8], 'Activo') !== false) {
        $activos++;
    } else {
        $inactivos++;
    }
    
    if (strpos($conductor[3], 'Masculino') !== false) {
        $masculinos++;
    } elseif (strpos($conductor[3], 'Femenino') !== false) {
        $femeninos++;
    }
}

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Total Conductores:</strong> ' . $totalConductores . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Activos:</strong> ' . $activos . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Masculinos:</strong> ' . $masculinos . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px;">
            <strong>Femeninos:</strong> ' . $femeninos . '
        </div>
    </div>
</div>';

// Sección del listado de conductores
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE CONDUCTORES FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Documento</th>
            <th>Género</th>
            <th>Dirección</th>
            <th>Licencia</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($conductores as $conductor) {
    $html .= '<tr>';
    
    // ID
    $html .= '<td>' . htmlspecialchars($conductor[0]) . '</td>';
    
    // Nombre Completo
    $html .= '<td>' . htmlspecialchars($conductor[1]) . '</td>';
    
    // Documento
    $html .= '<td>' . htmlspecialchars($conductor[2]) . '</td>';
    
    // Género
    $html .= '<td>' . htmlspecialchars($conductor[3]) . '</td>';
    
    // Dirección
    $html .= '<td>' . htmlspecialchars($conductor[4]) . '</td>';
    
    // Licencia
    $html .= '<td>' . htmlspecialchars($conductor[5]) . '</td>';
    
    // Teléfono
    $html .= '<td>' . htmlspecialchars($conductor[6]) . '</td>';
    
    // Correo
    $html .= '<td>' . htmlspecialchars($conductor[7]) . '</td>';
    
    // Estado
    $estado = $conductor[8];
    if (strpos($estado, 'Activo') !== false) {
        $html .= '<td class="text-center"><span class="badge badge-success">Activo</span></td>';
    } else {
        $html .= '<td class="text-center"><span class="badge badge-danger">Inactivo</span></td>';
    }
    
 
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de conductores.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Conductores_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>