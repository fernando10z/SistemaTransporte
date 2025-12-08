<?php
// Iniciar buffer de salida al principio para evitar errores de "headers already sent"
ob_start();
require('../conexion/conexion.php');
require('../fpdf/fpdf.php');

// Establecer la zona horaria
date_default_timezone_set('America/Lima');

// Recibir parámetros con validación
$tipo = isset($_GET['tipo']) && in_array($_GET['tipo'], ['natural', 'empresa']) ? $_GET['tipo'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$id || !$tipo) {
    die('Parámetros inválidos');
}

// Configuración de diseño profesional
$config = [
    'logo_path' => '../configuracion/empresa/logo', // Ruta base del logo
    'title' => 'HISTORIAL DE SERVICIOS',
    'subtitle' => 'Generado el ' . date('d/m/Y \a \l\a\s H:i'),
    'font' => 'Arial',
    'primary_color' => [13, 71, 161],  // Azul oscuro
    'secondary_color' => [245, 245, 245],  // Gris claro
    'header_color' => [255, 255, 255],  // Blanco
    'date_time_color' => [33, 33, 33],  // Gris oscuro
    'accent_color' => [236, 64, 122],  // Rosa
    'margin_left' => 15,
    'image_size' => 30,
    'title_y_position' => 22,
    'info_y_position' => 45,
    'table_y_position' => 110, // Aumentado para bajar la tabla
    'row_height' => 9,
    'footer_text' => 'Transportes y Logística - Todos los derechos reservados'
];

// Obtener el logo actual de la empresa
$logo = 'default_logo.jpg'; // Valor por defecto
try {
    $stmt = $conn->prepare("SELECT logo FROM configuracion_empresa LIMIT 1");
    $stmt->execute();
    $logoData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($logoData && !empty($logoData['logo'])) {
        $logo = $logoData['logo'];
    }
} catch (PDOException $e) {
    // Continuar con el logo por defecto si hay error
}
$config['logo_path'] = '../configuracion/empresa/' . $logo;

class ServiciosPDF extends FPDF {
    private $config;
    private $tipo;
    private $infoCliente;
    
    function __construct($config, $tipo, $infoCliente, $orientation='L', $unit='mm', $size='A4') {
        parent::__construct($orientation, $unit, $size);
        $this->config = $config;
        $this->tipo = $tipo;
        $this->infoCliente = $infoCliente;
        $this->SetLeftMargin($this->config['margin_left']);
    }
    
    function Header() {
        // Logo de la empresa
        if (file_exists($this->config['logo_path'])) {
            $this->Image($this->config['logo_path'], 15, 10, $this->config['image_size']);
        }
        
        // Título principal
        $this->SetY($this->config['title_y_position']);
        $this->SetFont($this->config['font'], 'B', 18);
        $this->SetTextColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Cell(0, 10, $this->config['title'], 0, 1, 'C');
        
        // Subtítulo con fecha
        $this->SetFont($this->config['font'], 'I', 11);
        $this->SetTextColor(
            $this->config['date_time_color'][0], 
            $this->config['date_time_color'][1], 
            $this->config['date_time_color'][2]
        );
        $this->Cell(0, 6, $this->config['subtitle'], 0, 1, 'C');
        
        // Línea decorativa
        $this->SetDrawColor(
            $this->config['accent_color'][0], 
            $this->config['accent_color'][1], 
            $this->config['accent_color'][2]
        );
        $this->SetLineWidth(0.8);
        $this->Line($this->GetPageWidth()/4, $this->GetY()+2, $this->GetPageWidth()*3/4, $this->GetY()+2);
        $this->Ln(10);
        
        // Información del cliente/empresa
        $this->SetY($this->config['info_y_position']);
        $this->SetFont($this->config['font'], 'B', 12);
        $this->SetTextColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Cell(0, 8, 'INFORMACIÓN DEL ' . ($this->tipo === 'natural' ? 'CLIENTE' : 'EMPRESA'), 0, 1);
        
        $this->SetFont($this->config['font'], '', 11);
        $this->SetTextColor(0);
        
        if ($this->tipo === 'natural') {
            $nombreCompleto = ($this->infoCliente['nombres'] ?? '') . ' ' . 
                            ($this->infoCliente['apePaterno'] ?? '') . ' ' . 
                            ($this->infoCliente['apeMaterno'] ?? '');
            $this->Cell(50, 8, 'Nombre:', 0, 0);
            $this->Cell(0, 8, utf8_decode(trim($nombreCompleto)) ?: 'No especificado', 0, 1);
            $this->Cell(50, 8, 'Documento:', 0, 0);
            $doc = ($this->infoCliente['tipoDocumento'] ?? '') . ' - ' . ($this->infoCliente['numerodocumento'] ?? '');
            $this->Cell(0, 8, utf8_decode(trim($doc)) ?: 'No especificado', 0, 1);
        } else {
            $this->Cell(50, 8, 'Razón Social:', 0, 0);
            $this->Cell(0, 8, utf8_decode($this->infoCliente['razonSocial'] ?? 'No especificado'), 0, 1);
            $this->Cell(50, 8, 'RUC:', 0, 0);
            $ruc = ($this->infoCliente['ruc'] ?? '') . ' (' . ($this->infoCliente['tipoRuc'] ?? '') . ')';
            $this->Cell(0, 8, utf8_decode(trim($ruc)) ?: 'No especificado', 0, 1);
        }

        $this->Cell(50, 8, 'Telefono:', 0, 0);
        $this->Cell(0, 8, $this->infoCliente['telefono'] ?? 'No registrado', 0, 1);
        $this->Cell(50, 8, 'Correo:', 0, 0);
        $this->Cell(0, 8, $this->infoCliente['correo'] ?? 'No registrado', 0, 1);
        $this->Cell(50, 8, 'Direccion:', 0, 0);
        $this->Cell(0, 8, utf8_decode($this->infoCliente['direccion'] ?? 'No registrada'), 0, 1);
        
        $this->Ln(15); // Aumentado para separar más la tabla
    }
    
    function Footer() {
        $this->SetY(-20);
        $this->SetFont($this->config['font'], 'I', 9);
        $this->SetTextColor(100);
        
        // Línea decorativa
        $this->SetDrawColor(200, 200, 200);
        $this->Line(15, $this->GetY(), $this->GetPageWidth()-15, $this->GetY());
        $this->Ln(4);
        
        // Texto del footer
        $this->Cell(0, 6, utf8_decode($this->config['footer_text']), 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(0, 6, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    
    function ImprovedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='L', $fill=false, $fill_color=null) {
        if ($fill_color) {
            $this->SetFillColor($fill_color[0], $fill_color[1], $fill_color[2]);
            $fill = true;
        }
        $this->SetTextColor(0); // Texto siempre en negro
        $txt = utf8_decode($txt ?? '');
        $txt = $txt === '' ? '--' : $txt;
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill);
    }
}

// Obtener información del cliente/empresa con manejo de errores
$infoCliente = [];
try {
    if ($tipo === 'natural') {
        $stmt = $conn->prepare("
            SELECT cn.*, td.tipoDocumento 
            FROM clientes_naturales cn
            JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
            WHERE cn.idCliente = ?
        ");
    } else {
        $stmt = $conn->prepare("
            SELECT ce.*, tr.descripcion AS tipoRuc 
            FROM clientes_empresas ce
            JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
            WHERE ce.idEmpresa = ?
        ");
    }
    $stmt->execute([$id]);
    $infoCliente = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
} catch (PDOException $e) {
    die('Error al obtener información del cliente: ' . $e->getMessage());
}

if (empty($infoCliente)) {
    die('Cliente/Empresa no encontrado');
}

// Obtener historial de servicios con manejo de errores
$servicios = [];
try {
    if ($tipo === 'natural') {
        $stmt = $conn->prepare("
            SELECT 
                cn.idContrato,
                s.nombreServicio AS servicio,
                z.nombreZona AS zona,
                d.fechaServicio,
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
            ORDER BY d.fechaServicio DESC
        ");
    } else {
        $stmt = $conn->prepare("
            SELECT 
                ce.idContratoempresa AS idContrato,
                d.servicio,
                d.Zona AS zona,
                d.fechaServicio,
                d.origen,
                d.destino,
                d.peso,
                d.volumen,
                d.monto,
                ce.estado
            FROM contratos_empresas ce
            JOIN detalle_contrato_empresa d ON ce.idContratoempresa = d.idContratoempresa
            WHERE ce.idEmpresa = ?
            ORDER BY d.fechaServicio DESC
        ");
    }
    $stmt->execute([$id]);
    $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
} catch (PDOException $e) {
    die('Error al obtener historial de servicios: ' . $e->getMessage());
}

// Crear PDF
try {
    $pdf = new ServiciosPDF($config, $tipo, $infoCliente, 'L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont($config['font'], '', 10);
    $pdf->SetTextColor(50);
    $pdf->SetDrawColor(220);

    // Configuración de la tabla
    $column_widths = [15, 20, 20, 40, 25, 40, 40, 15, 15, 20, 20];
    $headers = ['#', 'Contrato', 'Fecha', 'Servicio', 'Zona', 'Origen', 'Destino', 'Peso', 'Volumen', 'Monto', 'Estado'];
    $total_width = array_sum($column_widths);
    $start_x = ($pdf->GetPageWidth() - $total_width) / 2;

    // Encabezado de la tabla
    $pdf->SetY($config['table_y_position']);
    $pdf->SetX($start_x);
    $pdf->SetFont($config['font'], 'B', 11);
    $pdf->SetFillColor(
        $config['primary_color'][0], 
        $config['primary_color'][1], 
        $config['primary_color'][2]
    );
    $pdf->SetTextColor(255); // Texto en blanco para el encabezado

    for ($i = 0; $i < count($headers); $i++) {
        $pdf->Cell($column_widths[$i], 10, utf8_decode($headers[$i]), 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Colores para estados
    $colores_estado = [
        'pendiente' => [243, 156, 18],   // Naranja
        'en proceso' => [46, 204, 113],   // Verde
        'completado' => [52, 152, 219],   // Azul
        'anulado' => [231, 76, 60]        // Rojo
    ];

    // Datos de la tabla
    $fill = false;
    $pdf->SetFont($config['font'], '', 9);
    $pdf->SetTextColor(0); // Texto en negro
    $totalMonto = 0;

    foreach ($servicios as $index => $servicio) {
        // Alternar color de fondo para filas
        $fill = !$fill;
        $pdf->SetFillColor($fill ? 240 : 255, $fill ? 240 : 255, $fill ? 240 : 255);
        
        // Posicionar fila centrada
        $pdf->SetX($start_x);
        
        // Número de fila
        $pdf->Cell($column_widths[0], $config['row_height'], $index + 1, 'LR', 0, 'C', $fill);
        
        // Contrato
        $pdf->Cell($column_widths[1], $config['row_height'], $servicio['idContrato'] ?? '--', 'LR', 0, 'C', $fill);
        
        // Fecha
        $fecha = isset($servicio['fechaServicio']) ? date('d/m/Y', strtotime($servicio['fechaServicio'])) : '--';
        $pdf->Cell($column_widths[2], $config['row_height'], $fecha, 'LR', 0, 'C', $fill);
        
        // Servicio
        $servicioTexto = isset($servicio['servicio']) ? substr($servicio['servicio'], 0, 20) : '--';
        $pdf->ImprovedCell($column_widths[3], $config['row_height'], $servicioTexto, 'LR', 0, 'L', $fill);
        
        // Zona
        $pdf->ImprovedCell($column_widths[4], $config['row_height'], $servicio['zona'] ?? '--', 'LR', 0, 'C', $fill);
        
        // Origen
        $origen = isset($servicio['origen']) ? substr($servicio['origen'], 0, 20) : '--';
        $pdf->ImprovedCell($column_widths[5], $config['row_height'], $origen, 'LR', 0, 'L', $fill);
        
        // Destino
        $destino = isset($servicio['destino']) ? substr($servicio['destino'], 0, 20) : '--';
        $pdf->ImprovedCell($column_widths[6], $config['row_height'], $destino, 'LR', 0, 'L', $fill);
        
        // Peso
        $peso = isset($servicio['peso']) ? number_format($servicio['peso'], 2) : '-';
        $pdf->Cell($column_widths[7], $config['row_height'], $peso, 'LR', 0, 'C', $fill);
        
        // Volumen
        $volumen = isset($servicio['volumen']) ? number_format($servicio['volumen'], 2) : '-';
        $pdf->Cell($column_widths[8], $config['row_height'], $volumen, 'LR', 0, 'C', $fill);
        
        // Monto
        $monto = isset($servicio['monto']) ? floatval($servicio['monto']) : 0;
        $pdf->Cell($column_widths[9], $config['row_height'], 'S/ ' . number_format($monto, 2), 'LR', 0, 'R', $fill);
        $totalMonto += $monto;
        
        // Estado con color
        $estado = isset($servicio['estado']) ? strtolower($servicio['estado']) : 'desconocido';
        $color_estado = $colores_estado[$estado] ?? [200, 200, 200];
        $pdf->SetFillColor($color_estado[0], $color_estado[1], $color_estado[2]);
        $estadoTexto = isset($servicio['estado']) ? ucfirst($servicio['estado']) : '--';
        $pdf->Cell($column_widths[10], $config['row_height'], utf8_decode($estadoTexto), 'LR', 1, 'C', true);
        
        // Verificar si necesita nueva página
        if($pdf->GetY() > 180) {
            $pdf->AddPage();
            $fill = false;
        }
    }

    // Total
    $pdf->SetX($start_x);
    $pdf->SetFont($config['font'], 'B', 10);
    $pdf->SetFillColor(220, 220, 220);
    $pdf->Cell(array_sum(array_slice($column_widths, 0, 10)), 8, 'TOTAL:', 'LTB', 0, 'R', true);
    $pdf->Cell($column_widths[10], 8, 'S/ ' . number_format($totalMonto, 2), 'TRB', 1, 'R', true);

    // Limpiar buffer y generar PDF
    ob_end_clean();
    
    // Nombre del archivo
    $nombreArchivo = 'Historial_Servicios_';
    if ($tipo === 'natural') {
        $nombreArchivo .= isset($infoCliente['nombres']) ? $infoCliente['nombres'] : 'Cliente';
    } else {
        $nombreArchivo .= isset($infoCliente['razonSocial']) ? $infoCliente['razonSocial'] : 'Empresa';
    }
    $nombreArchivo .= '.pdf';
    
    $pdf->Output('D', $nombreArchivo);
    
} catch (Exception $e) {
    die('Error al generar PDF: ' . $e->getMessage());
}