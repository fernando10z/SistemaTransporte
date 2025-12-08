<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Obtener los datos filtrados desde el formulario POST
$seguros = isset($_POST['filteredData']) ? json_decode($_POST['filteredData'], true) : [];

// Verificar si los datos llegaron correctamente
if (!$seguros || empty($seguros)) {
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
    .badge-warning { background-color: #ffc107; color: #212529; }
    .badge-danger { background-color: #dc3545; }
    .badge-success { background-color: #28a745; }
    .badge-secondary { background-color: #6c757d; }
    .stats-container { display: flex; justify-content: space-between; margin-bottom: 15px; }
    .stat-box { width: 32%; padding: 10px; background-color: #e9ecef; border-radius: 5px; text-align: center; }
    .text-center { text-align: center; }
    .warning-row { background-color: #fff3cd !important; }
    .danger-row { background-color: #f8d7da !important; }
</style>';

// Cabecera con el logo y título
$html .= '<table width="100%">
    <tr>
        <td width="20%" style="text-align: left;">
            <img src="' . $logoSrc . '" style="width: 100px;">
        </td>
        <td width="60%" style="text-align: center;">
            <div class="header">
                <h2 class="title">SISTEMA DE GESTIÓN DE VEHÍCULOS</h2>
                <p class="subtitle">Reporte de Seguros de Vehículos</p>
            </div>
        </td>
        <td width="20%" style="text-align: right;">
            <div class="report-box">
                <h4>REPORTE DE SEGUROS</h4>
                <h4>' . date('d/m/Y') . '</h4>
            </div>
        </td>
    </tr>
</table>';

// Resumen estadístico
$totalSeguros = count($seguros);
$segurosPendientes = 0;
$segurosVencidos = 0;
$segurosRealizados = 0;
$segurosAnulados = 0;
$tiposSeguro = [];

foreach ($seguros as $seguro) {
    switch ($seguro['estado']) {
        case 'Pendiente': $segurosPendientes++; break;
        case 'Vencido': $segurosVencidos++; break;
        case 'Realizada': $segurosRealizados++; break;
        case 'Anulada': $segurosAnulados++; break;
    }
    
    $tipo = $seguro['nombre_seguro'];
    if (!isset($tiposSeguro[$tipo])) {
        $tiposSeguro[$tipo] = 0;
    }
    $tiposSeguro[$tipo]++;
}

$html .= '<div class="stats-container">
    <div class="stat-box">
        <strong>Total Seguros:</strong> ' . $totalSeguros . '
    </div>
    <div class="stat-box">
        <strong>Pendientes:</strong> ' . $segurosPendientes . '
    </div>
    <div class="stat-box">
        <strong>Vencidos:</strong> ' . $segurosVencidos . '
    </div>
    <div class="stat-box">
        <strong>Realizados:</strong> ' . $segurosRealizados . '
    </div>
    <div class="stat-box">
        <strong>Anulados:</strong> ' . $segurosAnulados . '
    </div>
</div>';

// Tipos de seguro
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">TIPOS DE SEGURO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>Tipo de Seguro</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>';

foreach ($tiposSeguro as $tipo => $cantidad) {
    $html .= '<tr>
        <td>' . htmlspecialchars($tipo) . '</td>
        <td class="text-center">' . $cantidad . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Sección del listado de seguros
$html .= '<div style="margin-top: 15px; font-weight: bold; background-color: #5d87ff; color: white; padding: 10px; border-radius: 5px;">LISTADO DE SEGUROS FILTRADO</div>';
$html .= '<table class="table-container">
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Tipo Seguro</th>
            <th>N° Póliza</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

// Recorrer cada registro
foreach ($seguros as $seguro) {
    // Determinar clase de fila según estado
    $rowClass = '';
    if ($seguro['estado'] === 'Vencido') {
        $rowClass = 'danger-row';
    } elseif ($seguro['estado'] === 'Pendiente') {
        $rowClass = 'warning-row';
    }
    
    $html .= '<tr class="' . $rowClass . '">';
    
    // ID
    $html .= '<td class="text-center">' . htmlspecialchars($seguro['idSeguro']) . '</td>';
    
    // Código
    $html .= '<td>' . htmlspecialchars($seguro['codigo']) . '</td>';
    
    // Placa
    $html .= '<td>' . htmlspecialchars($seguro['placa']) . '</td>';
    
    // Marca
    $html .= '<td>' . htmlspecialchars($seguro['marca']) . '</td>';
    
    // Modelo
    $html .= '<td>' . htmlspecialchars($seguro['modelo']) . '</td>';
    
    // Tipo Seguro
    $html .= '<td>' . htmlspecialchars($seguro['nombre_seguro']) . '</td>';
    
    // N° Póliza
    $html .= '<td>' . htmlspecialchars($seguro['numero_poliza']) . '</td>';
    
    // Estado
    $estado = trim($seguro['estado']);
    $badgeClass = match ($estado) {
        'Pendiente' => 'badge-warning',
        'Vencido' => 'badge-danger',
        'Realizada' => 'badge-success',
        'Anulada' => 'badge-secondary',
        default => ''
    };
    $html .= '<td class="text-center"><span class="badge ' . $badgeClass . '">' . $estado . '</span></td>';
    
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Pie de página
$html .= '<div class="pie-pagina">
    Reporte generado por el sistema de gestión de vehículos.<br>
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
header('Content-Disposition: attachment; filename="Reporte_Seguros_' . date('Ymd_His') . '.pdf"');
echo $dompdf->output();
exit;
?>