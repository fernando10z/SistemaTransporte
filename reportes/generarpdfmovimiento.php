<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$movimientos = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$movimientos || empty($movimientos)) {
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
    .badge-primary { background-color: #5d87ff; }
    .badge-success { background-color: #28a745; }
    .badge-info { background-color: #17a2b8; }
    .badge-warning { background-color: #ffc107; color: #212529; }
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
                <h2 class="title">GESTIÓN DE MOVIMIENTOS DE PRODUCTOS</h2>
                <p class="subtitle">Reporte de Movimientos de Inventario</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE MOVIMIENTOS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalMovimientos = count($movimientos);
$entradas = 0;
$salidas = 0;
$ajustes = 0;
$Entránsito = 0;
$Almacenado = 0;
$Pendienterevisión = 0;
$devoluciones = 0;

foreach ($movimientos as $mov) {
    // Contar por tipo de movimiento
    if ($mov[9] === 'Entrada') $entradas++;
    elseif ($mov[9] === 'Salida') $salidas++;
    elseif ($mov[9] === 'Ajuste') $ajustes++;
    
    // Contar por motivo
    if ($mov[10] === 'En tránsito') $Entránsito++;
    elseif ($mov[10] === 'Almacenado') $Almacenado++;
    elseif ($mov[10] === 'Pendiente revisión') $Pendienterevisión++;
    elseif ($mov[10] === 'Devolución') $devoluciones++;
}

$html .= '<div style="margin-top: 15px; font-weight: bold; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f9fa;">
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px; margin-bottom: 5px;">
            <strong>Total Movimientos:</strong> ' . $totalMovimientos . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px; margin-bottom: 5px;">
            <strong>Entradas:</strong> ' . $entradas . '
        </div>
        <div style="width: 24%; text-align: center; padding: 10px; background-color: #e9ecef; border-radius: 5px; margin-bottom: 5px;">
            <strong>Salidas:</strong> ' . $salidas . '
        </div>
    </div>';

// Sección del listado de movimientos
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">DETALLE DE MOVIMIENTOS</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Almacén</th>
            <th>Categoría</th>
            <th>Subcategoría</th>
            <th>Código</th>
            <th>Producto</th>
            <th class="text-right">Stock Mín.</th>
            <th class="text-right">Stock Inic.</th>
            <th class="text-right">Stock Final</th>
            <th>Tipo</th>
            <th>Motivo</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($movimientos as $mov) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($mov[0]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[1]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[2]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[3]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[4]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[5]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[6]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[7]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[8]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[9]) . '</td>';
    
    // Motivo con badge
    $motivo = $mov[10];
    $badgeClass = '';
    switch($motivo) {
        case 'En tránsito': $badgeClass = 'bg-primary'; break;
          case 'Almacenado': $badgeClass = 'bg-success'; break;
         case 'Pendiente revisión': $badgeClass = 'bg-info'; break;
          case 'Entrega': $badgeClass = 'bg-warning'; break;
             case 'Traslado': $badgeClass = 'bg-secondary'; break;
          default: $badgeClass = 'bg-light text-dark'; break;
    }
    $html .= '<td><span class="' . $badgeClass . '">' . htmlspecialchars($motivo) . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de inventarios.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Movimientos_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>