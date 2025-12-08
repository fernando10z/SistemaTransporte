<?php
// Configurar zona horaria de Lima, Perú
date_default_timezone_set('America/Lima');

require('../fpdf/fpdf.php');
require('../conexion/conexion.php');

// Verificar parámetros
if (!isset($_GET['tipo']) || !isset($_GET['id'])) {
    die("Parámetros incompletos");
}

$tipo = $_GET['tipo']; // 'natural' o 'empresa'
$id = $_GET['id'];

// Configuración de diseño profesional
$config = [
    'title' => 'REPORTE DE CONTRATOS',
    'font' => 'Arial',
    'primary_color' => [13, 71, 161],  // Azul oscuro
    'secondary_color' => [79, 195, 247],  // Azul claro
    'header_color' => [255, 255, 255],  // Blanco
    'text_color' => [33, 33, 33],  // Gris oscuro
    'accent_color' => [236, 64, 122],  // Rosa
    'column_widths' => [25, 30, 30, 30, 30, 30, 25, 25, 25, 25], // Anchos de columnas
    'margin_left' => 15,
    'title_y_position' => 20,
    'info_y_position' => 30,
    'table_y_position' => 50,
    'row_height' => 8
];

// Colores para estados
$colores_estado = [
    'Pendiente' => [255, 193, 7],    // Amarillo
    'En Proceso' => [23, 162, 184],  // Azul claro
    'Completado' => [40, 167, 69],   // Verde
    'Anulado' => [220, 53, 69],      // Rojo
    'default' => [189, 189, 189]     // Gris
];

class ContratosPDF extends FPDF {
    private $config;
    private $colores_estado;
    private $clienteInfo;
    private $tipo;
    
    function __construct($config, $colores_estado, $clienteInfo, $tipo, $orientation='L', $unit='mm', $size='A4') {
        parent::__construct($orientation, $unit, $size);
        $this->config = $config;
        $this->colores_estado = $colores_estado;
        $this->clienteInfo = $clienteInfo;
        $this->tipo = $tipo;
        $this->SetLeftMargin($this->config['margin_left']);
    }
    
    function Header() {
        // Título
        $this->SetY($this->config['title_y_position']);
        $this->SetFont($this->config['font'], 'B', 16);
        $this->SetTextColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Cell(0, 10, $this->config['title'], 0, 1, 'C');
        
        // Subtítulo con fecha (hora de Lima)
        $this->SetFont($this->config['font'], 'I', 10);
        $this->SetTextColor($this->config['text_color'][0], $this->config['text_color'][1], $this->config['text_color'][2]);
        $fechaHoraLima = date('d/m/Y \a \l\a\s H:i');
        $this->Cell(0, 5, mb_convert_encoding('Generado el ' . $fechaHoraLima, 'Windows-1252', 'UTF-8'), 0, 1, 'C');
        
        // Información del cliente/empresa
        $this->SetY($this->config['info_y_position']);
        $this->SetFont($this->config['font'], 'B', 11);
        $this->SetTextColor($this->config['primary_color'][0], $this->config['primary_color'][1], $this->config['primary_color'][2]);
        
        // Nombre/Razón Social
        $label = $this->tipo === 'natural' ? 'Nombre:' : 'Razón Social:';
        $value = $this->tipo === 'natural' ? 
            $this->clienteInfo['nombre'].' '.$this->clienteInfo['apellidopat'].' '.$this->clienteInfo['apellidoMat'] : 
            $this->clienteInfo['razonSocial'];
        
        $this->Cell(40, 6, mb_convert_encoding($label, 'Windows-1252', 'UTF-8'), 0, 0, 'L');
        $this->SetFont($this->config['font'], '', 11);
        $this->Cell(0, 6, mb_convert_encoding($value, 'Windows-1252', 'UTF-8'), 0, 1, 'L');
        
        // Documento/RUC
        $this->SetFont($this->config['font'], 'B', 11);
        $label = $this->tipo === 'natural' ? 'Documento:' : 'RUC:';
        $value = $this->tipo === 'natural' ? 
            $this->clienteInfo['tipoDocumento'].' - '.$this->clienteInfo['numerodocumento'] : 
            $this->clienteInfo['ruc'].' ('.$this->clienteInfo['tipoRuc'].')';
        
        $this->Cell(40, 6, mb_convert_encoding($label, 'Windows-1252', 'UTF-8'), 0, 0, 'L');
        $this->SetFont($this->config['font'], '', 11);
        $this->Cell(50, 6, mb_convert_encoding($value, 'Windows-1252', 'UTF-8'), 0, 0, 'L');
        
        // Teléfono
        $this->SetFont($this->config['font'], 'B', 11);
        $this->Cell(30, 6, mb_convert_encoding('Teléfono:', 'Windows-1252', 'UTF-8'), 0, 0, 'L');
        $this->SetFont($this->config['font'], '', 11);
        $this->Cell(0, 6, mb_convert_encoding($this->clienteInfo['telefono'] ?? 'No registrado', 'Windows-1252', 'UTF-8'), 0, 1, 'L');
        
        // Dirección
        $this->SetFont($this->config['font'], 'B', 11);
        $this->Cell(40, 6, mb_convert_encoding('Dirección:', 'Windows-1252', 'UTF-8'), 0, 0, 'L');
        $this->SetFont($this->config['font'], '', 11);
        $this->Cell(0, 6, mb_convert_encoding($this->clienteInfo['direccion'] ?? 'No registrada', 'Windows-1252', 'UTF-8'), 0, 1, 'L');
        
        // Línea decorativa
        $this->SetDrawColor(
            $this->config['accent_color'][0], 
            $this->config['accent_color'][1], 
            $this->config['accent_color'][2]
        );
        $this->SetLineWidth(0.5);
        $this->Line($this->GetX(), $this->GetY()+3, $this->GetPageWidth()-$this->config['margin_left'], $this->GetY()+3);
        $this->Ln(8);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont($this->config['font'], 'I', 8);
        $this->SetTextColor(100);
        $this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    
    function ImprovedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='L', $fill=false, $fill_color=null) {
        if ($fill_color) {
            $this->SetFillColor($fill_color[0], $fill_color[1], $fill_color[2]);
            $fill = true;
        }
        $this->SetTextColor(0);
        
        // Manejo mejorado de caracteres especiales
        $txt = mb_convert_encoding($txt ?? '', 'Windows-1252', 'UTF-8');
        $txt = $txt === false ? '--' : $txt;
        
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill);
    }
}

try {
    // Obtener información del cliente/empresa
    if ($tipo === 'natural') {
        $sql_info = "SELECT 
                    cn.*, 
                    td.tipoDocumento 
                FROM clientes_naturales cn
                JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
                WHERE cn.idCliente = ?";
    } else {
        $sql_info = "SELECT 
                    ce.*, 
                    tr.descripcion AS tipoRuc 
                FROM clientes_empresas ce
                JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
                WHERE ce.idEmpresa = ?";
    }

    $stmt_info = $conn->prepare($sql_info);
    $stmt_info->execute([$id]);
    $cliente_info = $stmt_info->fetch(PDO::FETCH_ASSOC);

    if (!$cliente_info) {
        die("No se encontró información del cliente/empresa");
    }

    // Obtener historial de servicios
    if ($tipo === 'natural') {
        $sql_historial = "SELECT 
                        cn.idContrato,
                        s.nombreServicio AS servicio,
                        z.nombreZona AS zona,
                        DATE_FORMAT(d.fechaServicio, '%d/%m/%Y') as fechaServicio,
                        d.origen,
                        d.destino,
                        d.peso,
                        d.volumen,
                        d.monto,
                        cn.estado
                    FROM contratos_naturales cn
                    JOIN detalle_contrato_natural d ON cn.idContrato = d.idContrato
                    JOIN tarifas t ON d.idTarifa = t.idTarifa
                    JOIN servicios s ON t.idServicio = s.idServicio
                    JOIN zonas_cobertura z ON t.idZona = z.idZona
                    WHERE cn.idCliente = ?
                    ORDER BY d.fechaServicio DESC";
    } else {
        $sql_historial = "SELECT 
                        ce.idContratoempresa AS idContrato,
                        d.servicio,
                        d.Zona AS zona,
                        DATE_FORMAT(d.fechaServicio, '%d/%m/%Y') as fechaServicio,
                        d.origen,
                        d.destino,
                        d.peso,
                        d.volumen,
                        d.monto,
                        ce.estado
                    FROM contratos_empresas ce
                    JOIN detalle_contrato_empresa d ON ce.idContratoempresa = d.idContratoempresa
                    WHERE ce.idEmpresa = ?
                    ORDER BY d.fechaServicio DESC";
    }

    $stmt_historial = $conn->prepare($sql_historial);
    $stmt_historial->execute([$id]);
    $historial = $stmt_historial->fetchAll(PDO::FETCH_ASSOC);

    // Crear PDF
    $pdf = new ContratosPDF($config, $colores_estado, $cliente_info, $tipo, 'L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont($config['font'], '', 9);
    $pdf->SetTextColor($config['text_color'][0], $config['text_color'][1], $config['text_color'][2]);
    $pdf->SetDrawColor(200);

    // Encabezado de tabla
    $pdf->SetY($config['table_y_position']);
    $pdf->SetFont($config['font'], 'B', 10);
    $pdf->SetFillColor(
        $config['primary_color'][0], 
        $config['primary_color'][1], 
        $config['primary_color'][2]
    );
    $pdf->SetTextColor(255);

    // Columnas
    $headers = ['# Contrato', 'Fecha Servicio', 'Servicio', 'Zona', 'Origen', 'Destino', 'Peso(kg)', 'Volumen(m³)', 'Monto(S/)', 'Estado'];
    $widths = $config['column_widths'];

    for ($i = 0; $i < count($headers); $i++) {
        $pdf->Cell($widths[$i], 8, mb_convert_encoding($headers[$i], 'Windows-1252', 'UTF-8'), 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Datos de la tabla
    $fill = false;
    $pdf->SetFont($config['font'], '', 9);
    $pdf->SetTextColor(0);
    $totalMonto = 0;

    foreach ($historial as $row) {
        $fill = !$fill;
        $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

        $pdf->ImprovedCell($widths[0], $config['row_height'], $row['idContrato'], 'LR', 0, 'C', $fill);
        $pdf->ImprovedCell($widths[1], $config['row_height'], $row['fechaServicio'], 'LR', 0, 'C', $fill);
        $pdf->ImprovedCell($widths[2], $config['row_height'], $row['servicio'], 'LR', 0, 'L', $fill);
        $pdf->ImprovedCell($widths[3], $config['row_height'], $row['zona'], 'LR', 0, 'L', $fill);
        $pdf->ImprovedCell($widths[4], $config['row_height'], $row['origen'], 'LR', 0, 'L', $fill);
        $pdf->ImprovedCell($widths[5], $config['row_height'], $row['destino'], 'LR', 0, 'L', $fill);
        $pdf->ImprovedCell($widths[6], $config['row_height'], $row['peso'] ? number_format($row['peso'], 2) : '-', 'LR', 0, 'C', $fill);
        $pdf->ImprovedCell($widths[7], $config['row_height'], $row['volumen'] ? number_format($row['volumen'], 2) : '-', 'LR', 0, 'C', $fill);
        $pdf->ImprovedCell($widths[8], $config['row_height'], 'S/'.number_format($row['monto'], 2), 'LR', 0, 'R', $fill);
        
        $estado = $row['estado'];
        $color_estado = $colores_estado[$estado] ?? $colores_estado['default'];
        $pdf->ImprovedCell($widths[9], $config['row_height'], $estado, 'LR', 1, 'C', true, $color_estado);
        
        $totalMonto += floatval($row['monto']);
        
        if($pdf->GetY() > 180) {
            $pdf->AddPage();
            $fill = false;
        }
    }

    // Pie de tabla con total
    $pdf->SetFont($config['font'], 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->ImprovedCell(array_sum(array_slice($widths, 0, 8)), $config['row_height'], 'TOTAL:', 'LTB', 0, 'R', true);
    $pdf->ImprovedCell($widths[8], $config['row_height'], 'S/'.number_format($totalMonto, 2), 'RTB', 0, 'R', true);
    $pdf->ImprovedCell($widths[9], $config['row_height'], '', 'LRB', 1, 'C', true);

} catch(PDOException $e) {
    die("Error al generar el reporte: " . $e->getMessage());
}

// Salida del PDF con nombre de archivo que incluye fecha/hora de Lima y nombre del cliente
$nombreCliente = $tipo === 'natural' ? 
    $cliente_info['nombre'].'_'.$cliente_info['apellidopat'] : 
    str_replace(' ', '_', $cliente_info['razonSocial']);
$nombreArchivo = 'reporte_contratos_'.$nombreCliente.'_'.date('Ymd_His').'.pdf';
$pdf->Output('D', $nombreArchivo);
exit();
?>