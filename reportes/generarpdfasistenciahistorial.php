<?php
ob_start();
require('../conexion/conexion.php');
require('../fpdf/fpdf.php');

// Establecer la zona horaria
date_default_timezone_set('America/Lima');

// Recibir parámetros
$idConductor = isset($_GET['idConductor']) ? intval($_GET['idConductor']) : 0;
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$fechaDesde = isset($_GET['fechaDesde']) ? $_GET['fechaDesde'] : '';
$fechaHasta = isset($_GET['fechaHasta']) ? $_GET['fechaHasta'] : '';

if (!$idConductor) {
    die('ID de conductor no proporcionado');
}

// Configuración de diseño profesional
$config = [
    'logo_path' => '../configuracion/empresa/logo',
    'title' => 'HISTORIAL DE ASISTENCIA',
    'subtitle' => 'Generado el ' . date('d/m/Y \a \l\a\s H:i'),
    'font' => 'Arial',
    'primary_color' => [44, 60, 105],  // Azul oscuro
    'secondary_color' => [245, 245, 245],
    'header_color' => [255, 255, 255],
    'date_time_color' => [33, 33, 33],
    'accent_color' => [28, 118, 179],  // Azul claro
    'margin_left' => 15,
    'image_size' => 30,
    'title_y_position' => 22,
    'info_y_position' => 45,
    'table_y_position' => 110,
    'row_height' => 9,
    'footer_text' => 'Transportes y Logística - Todos los derechos reservados'
];

// Obtener el logo de la empresa
$logo = 'default_logo.jpg';
try {
    $stmt = $conn->prepare("SELECT logo FROM configuracion_empresa LIMIT 1");
    $stmt->execute();
    $logoData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($logoData && !empty($logoData['logo'])) {
        $logo = $logoData['logo'];
    }
} catch (PDOException $e) {
    // Continuar con el logo por defecto
}
$config['logo_path'] = '../configuracion/empresa/' . $logo;

class AsistenciaPDF extends FPDF {
    private $config;
    private $infoConductor;
    private $isUTF8 = true;
    private $fechaDesde;
    private $fechaHasta;
    
    function __construct($config, $infoConductor, $fechaDesde, $fechaHasta, $orientation='L', $unit='mm', $size='A4') {
        parent::__construct($orientation, $unit, $size);
        $this->config = $config;
        $this->infoConductor = $infoConductor;
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
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
        $this->Cell(0, 10, $this->encodeString($this->config['title']), 0, 1, 'C');
        
        // Subtítulo con fecha
        $this->SetFont($this->config['font'], 'I', 11);
        $this->SetTextColor(
            $this->config['date_time_color'][0], 
            $this->config['date_time_color'][1], 
            $this->config['date_time_color'][2]
        );
        $this->Cell(0, 6, $this->encodeString($this->config['subtitle']), 0, 1, 'C');
        
        // Línea decorativa
        $this->SetDrawColor(
            $this->config['accent_color'][0], 
            $this->config['accent_color'][1], 
            $this->config['accent_color'][2]
        );
        $this->SetLineWidth(0.8);
        $this->Line($this->GetX(), $this->GetY()+2, $this->GetPageWidth()-30, $this->GetY()+2);
        $this->Ln(10);
        
        // Información del conductor
        $this->SetY($this->config['info_y_position']);
        $this->SetFont($this->config['font'], 'B', 12);
        $this->SetTextColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Cell(0, 8, $this->encodeString('INFORMACIÓN DEL CONDUCTOR'), 0, 1);
        
        $this->SetFont($this->config['font'], '', 11);
        $this->SetTextColor(0);
        
        $this->Cell(50, 8, $this->encodeString('Nombre:'), 0, 0);
        $nombreCompleto = $this->infoConductor['nombre'] . ' ' . $this->infoConductor['Apepat'] . ' ' . $this->infoConductor['Apemat'];
        $this->Cell(0, 8, $this->encodeString($nombreCompleto), 0, 1);
        
        $this->Cell(50, 8, $this->encodeString('Documento:'), 0, 0);
        $doc = $this->infoConductor['tipoDocumento'] . ' - ' . $this->infoConductor['documento'];
        $this->Cell(0, 8, $this->encodeString($doc), 0, 1);
        
        $this->Cell(50, 8, $this->encodeString('Licencia:'), 0, 0);
        $licencia = $this->infoConductor['tipoLicencia'] . ' (' . $this->infoConductor['licencia'] . ')';
        $this->Cell(0, 8, $this->encodeString($licencia), 0, 1);
        
        $this->Ln(15);
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
        $this->Cell(0, 6, $this->encodeString($this->config['footer_text']), 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(0, 6, $this->encodeString('Página '.$this->PageNo().'/{nb}'), 0, 0, 'C');
    }
    
    function ImprovedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='L', $fill=false, $fill_color=null) {
        if ($fill_color) {
            $this->SetFillColor($fill_color[0], $fill_color[1], $fill_color[2]);
            $fill = true;
        }
        $this->SetTextColor(0);
        $txt = $txt === '' ? '--' : $txt;
        $this->Cell($w, $h, $this->encodeString($txt), $border, $ln, $align, $fill);
    }
    
    // Función para manejar correctamente los caracteres UTF-8
    function encodeString($str) {
        if ($this->isUTF8) {
            return iconv('UTF-8', 'windows-1252', $str);
        }
        return $str;
    }
    
    // Función para centrar la tabla
    function CenteredTable($headers, $data, $column_widths) {
        $total_width = array_sum($column_widths);
        $start_x = ($this->GetPageWidth() - $total_width) / 2;
        $this->SetX($start_x);
        
        // Encabezados de la tabla
        $this->SetFont($this->config['font'], 'B', 11);
        $this->SetFillColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->SetTextColor(255);
        
        for ($i = 0; $i < count($headers); $i++) {
            $this->Cell($column_widths[$i], 10, $this->encodeString($headers[$i]), 1, 0, 'C', true);
        }
        $this->Ln();
        
        // Datos de la tabla
        $fill = false;
        $this->SetFont($this->config['font'], '', 9);
        $this->SetTextColor(0);
        $totalHoras = 0;
        
        foreach ($data as $index => $asistencia) {
            // Verificar si necesita nueva página
            if($this->GetY() > $this->GetPageHeight() - 30) {
                $this->AddPage();
                $this->SetX($start_x);
                $fill = false;
            }
            
            // Alternar color de fondo para filas
            $fill = !$fill;
            $this->SetFillColor($fill ? 240 : 255, $fill ? 240 : 255, $fill ? 240 : 255);
            
            // Posicionar fila centrada
            $this->SetX($start_x);
            
            // Número de fila
            $this->Cell($column_widths[0], $this->config['row_height'], $index + 1, 'LR', 0, 'C', $fill);
            
            // Fecha
            $fecha = date('d/m/Y', strtotime($asistencia['fecha_registro']));
            $this->Cell($column_widths[1], $this->config['row_height'], $fecha, 'LR', 0, 'C', $fill);
            
            // Día
            $this->ImprovedCell($column_widths[2], $this->config['row_height'], $asistencia['dia'] ?? '--', 'LR', 0, 'C', $fill);
            
            // Entrada
            $this->Cell($column_widths[3], $this->config['row_height'], $asistencia['hora_entrada'] ?? '-', 'LR', 0, 'C', $fill);
            
            // Salida
            $this->Cell($column_widths[4], $this->config['row_height'], $asistencia['hora_salida'] ?? '-', 'LR', 0, 'C', $fill);
            
            // Horas
            $horas = $asistencia['horas_conducidas'] ?? '0';
            $this->Cell($column_widths[5], $this->config['row_height'], $horas . ' hrs', 'LR', 0, 'C', $fill);
            $totalHoras += floatval($horas);
            
            // Observaciones
            $obs = substr($asistencia['observaciones'] ?? '--', 0, 40);
            $this->ImprovedCell($column_widths[6], $this->config['row_height'], $obs, 'LR', 0, 'L', $fill);
            
            // Estado con color
            $estado = strtolower($asistencia['estado'] ?? 'ingreso');
            $color_estado = [
                'ingreso' => [46, 204, 113],    // Verde
                'ausente' => [231, 76, 60],     // Rojo
                'justificado' => [52, 152, 219], // Azul
                'descanso' => [153, 102, 255]   // Morado
            ][$estado] ?? [200, 200, 200];
            
            $this->SetFillColor($color_estado[0], $color_estado[1], $color_estado[2]);
            $estadoTexto = ucfirst($estado);
            $this->Cell($column_widths[7], $this->config['row_height'], $this->encodeString($estadoTexto), 'LR', 1, 'C', true);
        }
        
        // Total
        $this->SetX($start_x);
        $this->SetFont($this->config['font'], 'B', 10);
        $this->SetFillColor(220, 220, 220);
        $this->Cell(array_sum(array_slice($column_widths, 0, 6)), 8, $this->encodeString('TOTAL HORAS:'), 'LTB', 0, 'R', true);
        $this->Cell($column_widths[6], 8, number_format($totalHoras, 2) . ' hrs', 'TRB', 1, 'C', true);
    }
}

// Obtener información del conductor
try {
    $stmt = $conn->prepare("SELECT 
                            c.nombre, 
                            c.Apepat, 
                            c.Apemat,
                            c.numerodocumento as documento,
                            c.tipolicencia as tipoLicencia,
                            c.licencia,
                            td.tipoDocumento as tipoDocumento
                        FROM conductores c
                        JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                        WHERE c.idConductor = ?");
    $stmt->execute([$idConductor]);
    $infoConductor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$infoConductor) {
        die('Conductor no encontrado');
    }
} catch (PDOException $e) {
    die('Error al obtener información del conductor: ' . $e->getMessage());
}

// Obtener historial de asistencia con filtros
try {
    $sql = "SELECT 
                a.*
            FROM asistencia_conductores a
            WHERE a.idConductor = ?";
    
    $params = [$idConductor];
    
    // Aplicar filtros si existen
    if (!empty($fechaDesde) && !empty($fechaHasta)) {
        $sql .= " AND DATE(a.fecha_registro) BETWEEN ? AND ?";
        array_push($params, $fechaDesde, $fechaHasta);
    } elseif (!empty($fechaDesde)) {
        $sql .= " AND DATE(a.fecha_registro) >= ?";
        array_push($params, $fechaDesde);
    } elseif (!empty($fechaHasta)) {
        $sql .= " AND DATE(a.fecha_registro) <= ?";
        array_push($params, $fechaHasta);
    }
    
    if (!empty($busqueda)) {
        $sql .= " AND (a.dia LIKE ? OR a.observaciones LIKE ?)";
        $paramBusqueda = "%$busqueda%";
        array_push($params, $paramBusqueda, $paramBusqueda);
    }
    
    $sql .= " ORDER BY a.fecha_registro DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Error al obtener historial de asistencia: ' . $e->getMessage());
}

// Determinar el rango de fechas para el título del PDF
$fechaInicio = $fechaFin = null;

if (!empty($fechaDesde) || !empty($fechaHasta)) {
    // Usar las fechas del filtro si existen
    $fechaInicio = !empty($fechaDesde) ? new DateTime($fechaDesde) : null;
    $fechaFin = !empty($fechaHasta) ? new DateTime($fechaHasta) : null;
    
    // Si solo se proporcionó una fecha, usar la misma para inicio y fin
    if ($fechaInicio && !$fechaFin) {
        $fechaFin = clone $fechaInicio;
    } elseif (!$fechaInicio && $fechaFin) {
        $fechaInicio = clone $fechaFin;
    }
} else {
    // Si no hay filtro de fechas, usar el rango del primer al último registro
    if (count($historial) > 0) {
        $fechaInicio = new DateTime($historial[count($historial)-1]['fecha_registro']);
        $fechaFin = new DateTime($historial[0]['fecha_registro']);
    } else {
        // Si no hay registros, usar la fecha actual
        $fechaInicio = $fechaFin = new DateTime();
    }
}

// Crear PDF
try {
    $pdf = new AsistenciaPDF($config, $infoConductor, $fechaDesde, $fechaHasta, 'L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont($config['font'], '', 10);
    $pdf->SetTextColor(50);
    $pdf->SetDrawColor(220);
    
    // Mostrar período en el PDF
    $pdf->SetFont($config['font'], 'B', 10);
    $periodo = 'Período: ' . $fechaInicio->format('d/m/Y');
    if ($fechaInicio != $fechaFin) {
        $periodo .= ' - ' . $fechaFin->format('d/m/Y');
    }
    $pdf->Cell(0, 6, $pdf->encodeString($periodo), 0, 1);
    $pdf->Ln(5);

    // Configuración de la tabla
    $column_widths = [15, 25, 25, 25, 25, 30, 50, 25];
    $headers = ['#', 'Fecha', 'Día', 'Entrada', 'Salida', 'Horas', 'Observaciones', 'Estado'];
    
    // Generar tabla centrada
    $pdf->CenteredTable($headers, $historial, $column_widths);

    // Limpiar buffer y generar PDF
    ob_end_clean();
    
    // Nombre del archivo
    $nombreArchivo = 'Historial_Asistencia_' . str_replace(' ', '_', $infoConductor['nombre']) . '_' . 
                    ($fechaDesde ? str_replace('-', '', $fechaDesde) : '') . 
                    ($fechaHasta ? '_' . str_replace('-', '', $fechaHasta) : '') . 
                    '_' . date('Ymd_His') . '.pdf';
    
    $pdf->Output('D', $nombreArchivo);
    
} catch (Exception $e) {
    die('Error al generar PDF: ' . $e->getMessage());
}