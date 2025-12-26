<?php
require_once 'vendor/autoload.php';
require_once '../conexion/conexion.php'; 
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

// Función para limpiar HTML y obtener solo texto
function limpiarHTML($texto) {
    if (empty($texto)) return '';
    // Eliminar etiquetas HTML y decodificar entidades
    $limpio = strip_tags($texto);
    $limpio = html_entity_decode($limpio, ENT_QUOTES, 'UTF-8');
    return trim($limpio);
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
                <div class="title">'. $nombreEmpresa .'</div>
                <div class="subtitle">Ruc de la empresa: '. $ruc .'</div>
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
    $html .= '<td>' . $mov[0] . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[1]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[2]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[3]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[4]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[5]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[6]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[7]) . '</td>';
    $html .= '<td class="text-right">' . htmlspecialchars($mov[8]) . '</td>';
    $html .= '<td>' . htmlspecialchars($mov[9]) . '</td>';
    
    // Motivo con color directo
$motivo = strip_tags($mov[10]); // Nos aseguramos de tener solo el texto
$color = '#f8f9fa'; // Color por defecto (gris claro)
$textColor = '#000000';

switch(trim($motivo)) {
    case 'En tránsito':        $color = '#007bff'; $textColor = '#ffffff'; break;
    case 'Almacenado':         $color = '#28a745'; $textColor = '#ffffff'; break;
    case 'Pendiente revisión': $color = '#17a2b8'; $textColor = '#ffffff'; break;
    case 'Entrega':            $color = '#ffc107'; $textColor = '#000000'; break;
    case 'Traslado':           $color = '#6c757d'; $textColor = '#ffffff'; break;
}

// Generamos la celda con el estilo "inyectado" directamente
$html .= '<td><span style="background-color: '.$color.'; color: '.$textColor.'; padding: 2px 5px; border-radius: 3px;">' . htmlspecialchars($motivo) . '</span></td>';

    
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