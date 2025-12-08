<?php
require('../fpdf/fpdf.php');
require('../conexion/conexion.php');
date_default_timezone_set('America/Lima');

if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    die("Parámetros incompletos");
}

$id_contrato = $_GET['id'];
$tipo_contrato = $_GET['tipo']; // 'Natural' o 'Juridica'

// Actualizar estado a "Completado"
try {
    if ($tipo_contrato === 'Natural') {
        $sql_update = "UPDATE contratos_naturales SET estado = 'Completado' WHERE idContrato = ?";
    } else {
        $sql_update = "UPDATE contratos_empresas SET estado = 'Completado' WHERE idContratoempresa = ?";
    }
    
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->execute([$id_contrato]);
} catch(PDOException $e) {
    die("Error al actualizar el estado: " . $e->getMessage());
}

// Obtener información de la empresa
try {
    $sql_empresa = "SELECT nombre_empresa, ruc, direccion, telefono, correo, logo, firmas 
                   FROM configuracion_empresa 
                   ORDER BY id_configuracion DESC LIMIT 1";
    $stmt_empresa = $conn->query($sql_empresa);
    $empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);
    
    if (!$empresa) {
        $empresa = [
            'nombre_empresa' => 'Nombre de Empresa',
            'ruc' => 'RUC 12345678901',
            'direccion' => 'Dirección de la empresa',
            'telefono' => 'Teléfono 123456789',
            'correo' => 'correo@empresa.com',
            'logo' => null,
            'firmas' => null
        ];
    }
} catch(PDOException $e) {
    die("Error al obtener información de la empresa: " . $e->getMessage());
}

// Obtener términos y condiciones
try {
    $sql_terminos = "SELECT titulo, contenido FROM terminos_condiciones ORDER BY orden ASC";
    $stmt_terminos = $conn->query($sql_terminos);
    $terminos_condiciones = $stmt_terminos->fetchAll(PDO::FETCH_ASSOC);
    
    if (!$terminos_condiciones) {
        $terminos_condiciones = [
            ['titulo' => 'Términos Generales', 'contenido' => 'No se han configurado términos y condiciones.']
        ];
    }
} catch(PDOException $e) {
    die("Error al obtener términos y condiciones: " . $e->getMessage());
}

// Configuración con rutas absolutas
$base_dir = dirname(__DIR__);
$config = [
    'title' => 'COMPROBANTE DE TRANSPORTE',
    'font' => 'Arial',
    'primary_color' => [13, 71, 161],
    'secondary_color' => [79, 195, 247],
    'text_color' => [33, 33, 33],
    'accent_color' => [236, 64, 122],
    'margin_left' => 15,
    'margin_right' => 15,
    'logo_path' => isset($empresa['logo']) && !empty($empresa['logo']) ? $base_dir . '/configuracion/empresa/' . $empresa['logo'] : null,
    'firma_path' => isset($empresa['firmas']) && !empty($empresa['firmas']) ? $base_dir . '/configuracion/empresa/' . $empresa['firmas'] : null
];

class ContratoPDF extends FPDF {
    private $config;
    private $datos_contrato;
    private $detalles_contrato;
    private $empresa;
    private $firma_cliente;
    private $terminos;
    
    function __construct($config, $datos_contrato, $detalles_contrato, $empresa, $firma_cliente, $terminos, $orientation='P', $unit='mm', $size='A4') {
        parent::__construct($orientation, $unit, $size);
        $this->config = $config;
        $this->datos_contrato = $datos_contrato;
        $this->detalles_contrato = $detalles_contrato;
        $this->empresa = $empresa;
        $this->firma_cliente = $firma_cliente;
        $this->terminos = $terminos;
        $this->SetLeftMargin($this->config['margin_left']);
        $this->SetRightMargin($this->config['margin_right']);
        $this->SetAutoPageBreak(true, 25);
    }
    
    function Header() {
        // Encabezado con color
        $this->SetFillColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Rect(0, 0, $this->GetPageWidth(), 30, 'F');
        
        // Logo
        if ($this->config['logo_path'] && file_exists($this->config['logo_path'])) {
            try {
                $this->Image($this->config['logo_path'], 15, 5, 20);
            } catch (Exception $e) {
                error_log("Error al cargar logo: " . $e->getMessage());
            }
        }
        
        // Información empresa
        $this->SetY(5);
        $this->SetX($this->config['logo_path'] && file_exists($this->config['logo_path']) ? 40 : 15);
        $this->SetFont($this->config['font'], 'B', 12);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 6, $this->encodeString($this->empresa['nombre_empresa']), 0, 1);
        
        $this->SetX($this->config['logo_path'] && file_exists($this->config['logo_path']) ? 40 : 15);
        $this->SetFont($this->config['font'], '', 10);
        $this->Cell(0, 5, $this->encodeString('RUC: ' . $this->empresa['ruc']), 0, 1);
        
        $this->SetX($this->config['logo_path'] && file_exists($this->config['logo_path']) ? 40 : 15);
        $this->Cell(0, 5, $this->encodeString($this->empresa['direccion']), 0, 1);
        
        $this->SetX($this->config['logo_path'] && file_exists($this->config['logo_path']) ? 40 : 15);
        $this->Cell(0, 5, $this->encodeString('Tel: ' . $this->empresa['telefono'] . ' | Email: ' . $this->empresa['correo']), 0, 1);
        
        // Título
        $this->SetY(32);
        $this->SetFont($this->config['font'], 'B', 16);
        $this->SetTextColor(
            $this->config['primary_color'][0], 
            $this->config['primary_color'][1], 
            $this->config['primary_color'][2]
        );
        $this->Cell(0, 8, $this->encodeString($this->config['title']), 0, 1, 'C');
        
        // Número contrato
        $this->SetFont($this->config['font'], 'B', 14);
        $this->SetTextColor(
            $this->config['accent_color'][0], 
            $this->config['accent_color'][1], 
            $this->config['accent_color'][2]
        );
        $this->Cell(0, 7, $this->encodeString('N° ' . $this->datos_contrato['idContrato']), 0, 1, 'C');
        
        // Línea decorativa
        $this->SetDrawColor(
            $this->config['accent_color'][0], 
            $this->config['accent_color'][1], 
            $this->config['accent_color'][2]
        );
        $this->SetLineWidth(0.5);
        $this->Line($this->GetX(), $this->GetY()+3, $this->GetPageWidth()-$this->config['margin_left']-$this->config['margin_right'], $this->GetY()+3);
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont($this->config['font'], 'I', 8);
        $this->SetTextColor(100);
        $this->Cell(0, 5, $this->encodeString('Documento generado el ' . date('d/m/Y H:i')), 0, 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, $this->encodeString('Página '.$this->PageNo().'/{nb}'), 0, 0, 'C');
    }
    
    function encodeString($str) {
        return iconv('UTF-8', 'windows-1252', $str ?? '');
    }
    
    function generarContrato() {
        $this->AddPage();
        $this->SetFont($this->config['font'], '', 11);
        
        // Información del cliente
        $this->SetFont('', 'B');
        $this->SetFillColor(230, 230, 250);
        $this->Cell(0, 8, $this->encodeString('INFORMACIÓN DEL ' . ($this->datos_contrato['tipo'] === 'Natural' ? 'CLIENTE' : 'EMPRESA')), 0, 1, 'L', true);
        $this->SetFont('', '');
        $this->Ln(3);
        
        $this->SetFillColor(245, 245, 245);
        $this->SetDrawColor(200);
        $border = 'LTRB';
        $fill = true;
        
        if ($this->datos_contrato['tipo'] === 'Natural') {
            $this->createInfoRow('Nombre completo:', $this->datos_contrato['nombreCliente'], $border, $fill);
            $this->createInfoRow('Documento:', $this->datos_contrato['tipoDocumento'] . ' - ' . $this->datos_contrato['documento'], $border, !$fill);
            $this->createInfoRow('Dirección:', $this->datos_contrato['direccion'], $border, $fill);
            $this->createInfoRow('Teléfono:', $this->datos_contrato['telefono'], $border, !$fill);
            $this->createInfoRow('Email:', $this->datos_contrato['correo'], $border, $fill);
        } else {
            $this->createInfoRow('Razón Social:', $this->datos_contrato['razonSocial'], $border, $fill);
            $this->createInfoRow('RUC:', $this->datos_contrato['ruc'] . ' (' . $this->datos_contrato['tipoRuc'] . ')', $border, !$fill);
            $this->createInfoRow('Dirección:', $this->datos_contrato['direccion'], $border, $fill);
            $this->createInfoRow('Teléfono:', $this->datos_contrato['telefono'], $border, !$fill);
            $this->createInfoRow('Email:', $this->datos_contrato['correo'], $border, $fill);
        }
        
        $this->createInfoRow('Fecha de registro:', $this->datos_contrato['fechaRegistro'], $border, !$fill);
        $this->SetFont('', 'B');
        $this->createInfoRow('Estado:', $this->datos_contrato['estado'], $border, $fill);
        $this->SetFont('', '');
        $this->Ln(12);
        
        // Detalles del contrato
        $this->SetFont('', 'B');
        $this->SetFillColor(230, 230, 250);
        $this->Cell(0, 8, $this->encodeString('DETALLES DEL SERVICIO'), 0, 1, 'L', true);
        $this->SetFont('', '');
        $this->Ln(3);
        
        foreach ($this->detalles_contrato as $index => $detalle) {
            $this->SetFillColor(240, 240, 255);
            $this->Cell(0, 8, $this->encodeString('SERVICIO #' . ($index + 1)), 0, 1, 'L', true);
            $this->SetFillColor(245, 245, 245);
            
            $this->createInfoRow('Fecha de servicio:', $detalle['fechaServicio'], $border, false);
            $this->createInfoRow('Servicio:', $detalle['servicio'], $border, true);
            $this->createInfoRow('Zona:', $detalle['zona'], $border, false);
            $this->createInfoRow('Origen:', $detalle['origen'], $border, true);
            $this->createInfoRow('Destino:', $detalle['destino'], $border, false);
            
            if ($detalle['peso'] || $detalle['volumen']) {
                $carga_info = [];
                if ($detalle['peso']) $carga_info[] = 'Peso: ' . $detalle['peso'] . ' kg';
                if ($detalle['volumen']) $carga_info[] = 'Volumen: ' . $detalle['volumen'] . ' m³';
                $this->createInfoRow('Detalles de carga:', implode(' | ', $carga_info), $border, true);
            }
            
            $this->SetFont('', 'B');
            $this->createInfoRow('Monto:', 'S/ ' . number_format($detalle['monto'], 2), $border, false);
            $this->SetFont('', '');
            $this->MultiCellRow('Descripción:', $detalle['descripcion'] ?: 'Sin descripción adicional', $border, true);
            $this->Ln(5);
        }
        
        // Términos y condiciones
        $this->SetFont('', 'B');
        $this->SetFillColor(230, 230, 250);
        $this->Cell(0, 8, $this->encodeString('TÉRMINOS Y CONDICIONES'), 0, 1, 'L', true);
        $this->SetFont('', '');
        $this->Ln(3);
        
        $this->SetFont('', '', 10);
        foreach ($this->terminos as $termino) {
            $this->SetFont('', 'B');
            $this->Cell(0, 6, $this->encodeString($termino['titulo']), 0, 1);
            $this->SetFont('', '');
            
            $contenido = str_replace("\r\n", "\n", $termino['contenido']);
            $parrafos = explode("\n", $contenido);
            
            foreach ($parrafos as $parrafo) {
                if (trim($parrafo)) {
                    $this->MultiCell(0, 5, $this->encodeString(trim($parrafo)));
                    $this->Ln(2);
                }
            }
            $this->Ln(3);
        }
        $this->SetFont('', '', 11);
        $this->Ln(10);
        
        // SECCIÓN DE FIRMAS - VERSIÓN CORREGIDA
        $this->SetDrawColor(150);
        $this->Line($this->GetX(), $this->GetY(), $this->GetPageWidth()-$this->config['margin_left']-$this->config['margin_right'], $this->GetY());
        $this->Ln(8);
        
        $ancho_columna = ($this->GetPageWidth() - $this->config['margin_left'] - $this->config['margin_right']) / 2;
        
        // Firma del cliente
        $firma_cliente_path = $this->getFirmaPath($this->firma_cliente);
        if ($firma_cliente_path) {
            try {
                $this->Image($firma_cliente_path, $this->GetX() + 20, $this->GetY(), 40);
            } catch (Exception $e) {
                error_log("Error al cargar firma cliente: " . $e->getMessage());
                $this->Cell($ancho_columna, 20, '[Firma cliente no disponible]', 0, 0, 'C');
            }
        } else {
            $this->Cell($ancho_columna, 20, '[Firma cliente no disponible]', 0, 0, 'C');
        }
        
        // Firma de la empresa
        $firma_empresa_path = $this->config['firma_path'];
        if ($firma_empresa_path && file_exists($firma_empresa_path)) {
            try {
                $this->Image($firma_empresa_path, $this->GetX() + $ancho_columna + 20, $this->GetY(), 40);
            } catch (Exception $e) {
                error_log("Error al cargar firma empresa: " . $e->getMessage());
                $this->Cell($ancho_columna, 20, '[Firma empresa no disponible]', 0, 1, 'C');
            }
        } else {
            $this->Cell($ancho_columna, 20, '[Firma empresa no disponible]', 0, 1, 'C');
        }
        
        $this->Ln(15);
        $this->SetFont('', 'B');
        $this->Cell($ancho_columna, 5, $this->encodeString('FIRMA DEL CLIENTE'), 0, 0, 'C');
        $this->Cell($ancho_columna, 5, $this->encodeString('FIRMA DEL REPRESENTANTE'), 0, 1, 'C');
        
        $this->SetFont('', '');
        $this->Cell($ancho_columna, 5, $this->encodeString(
            $this->datos_contrato['tipo'] === 'Natural' ? 
            $this->datos_contrato['nombreCliente'] : 
            $this->datos_contrato['razonSocial']
        ), 0, 0, 'C');
        
        $this->Cell($ancho_columna, 5, $this->encodeString($this->empresa['nombre_empresa']), 0, 1, 'C');
        
        $this->SetFont('', 'I', 9);
        $this->Cell($ancho_columna, 5, $this->encodeString(
            $this->datos_contrato['tipo'] === 'Natural' ? 
            'DNI: ' . $this->datos_contrato['documento'] : 
            'RUC: ' . $this->datos_contrato['ruc']
        ), 0, 0, 'C');
        
        $this->Cell($ancho_columna, 5, $this->encodeString('RUC: ' . $this->empresa['ruc']), 0, 1, 'C');
    }
    
    private function getFirmaPath($filename) {
        if (empty($filename)) return null;
        
        $base_dir = dirname(__DIR__);
        $possible_paths = [
            $base_dir . '/configuracion/empresa/' . $filename,
            $base_dir . '/uploads/firmas/' . $filename,
            $base_dir . '/firmas/' . $filename,
            $base_dir . '/configuracion/' . $filename
        ];
        
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }
        
        return null;
    }
    
    private function createInfoRow($label, $value, $border, $fill) {
        $this->SetFont('', 'B');
        $this->Cell(50, 8, $this->encodeString($label), $border, 0, 'L', $fill);
        $this->SetFont('', '');
        $this->Cell(0, 8, $this->encodeString($value), $border, 1, 'L', $fill);
    }
    
    private function MultiCellRow($label, $value, $border, $fill) {
        $this->SetFont('', 'B');
        $this->Cell(40, 8, $this->encodeString($label), $border, 0, 'L', $fill);
        $this->SetFont('', '');
        $this->MultiCell(0, 8, $this->encodeString($value), $border, 'L', $fill);
    }
}

// Obtener información del contrato
try {
    if ($tipo_contrato === 'Natural') {
        $sql_contrato = "SELECT 
                        c.idContrato,
                        'Natural' AS tipo,
                        CONCAT(n.nombre, ' ', n.apellidopat, ' ', n.apellidoMat) AS nombreCliente,
                        NULL AS razonSocial,
                        td.tipoDocumento,
                        n.numerodocumento AS documento,
                        NULL AS tipoRuc,
                        NULL AS ruc,
                        'Completado' AS estado,
                        DATE_FORMAT(c.fechaRegistro, '%d/%m/%Y %H:%i') AS fechaRegistro,
                        n.direccion,
                        n.telefono,
                        n.correo,
                        n.Firmas AS firma_cliente
                    FROM contratos_naturales c
                    JOIN clientes_naturales n ON c.idCliente = n.idCliente
                    JOIN tipodocumento td ON n.idTipoDocumento = td.idTipoDocumento
                    WHERE c.idContrato = ?";
    } else {
        $sql_contrato = "SELECT 
                        e.idContratoempresa AS idContrato,
                        'Juridica' AS tipo,
                        NULL AS nombreCliente,
                        ce.razonSocial,
                        NULL AS tipoDocumento,
                        NULL AS documento,
                        tr.descripcion AS tipoRuc,
                        ce.ruc,
                        'Completado' AS estado,
                        DATE_FORMAT(e.fechaRegistro, '%d/%m/%Y %H:%i') AS fechaRegistro,
                        ce.direccion,
                        ce.telefono,
                        ce.correo,
                        ce.Firmas AS firma_cliente
                    FROM contratos_empresas e
                    JOIN clientes_empresas ce ON e.idEmpresa = ce.idEmpresa
                    JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
                    WHERE e.idContratoempresa = ?";
    }

    $stmt_contrato = $conn->prepare($sql_contrato);
    $stmt_contrato->execute([$id_contrato]);
    $datos_contrato = $stmt_contrato->fetch(PDO::FETCH_ASSOC);

    if (!$datos_contrato) {
        die("No se encontró el contrato especificado");
    }

    // Obtener detalles del contrato
    if ($tipo_contrato === 'Natural') {
        $sql_detalles = "SELECT 
                        s.nombreServicio AS servicio,
                        z.nombreZona AS zona,
                        DATE_FORMAT(d.fechaServicio, '%d/%m/%Y') AS fechaServicio,
                        d.origen,
                        d.destino,
                        d.peso,
                        d.volumen,
                        d.monto,
                        d.descripcion
                    FROM detalle_contrato_natural d
                    JOIN tarifas t ON d.idTarifa = t.idTarifa
                    JOIN servicios s ON t.idServicio = s.idServicio
                    JOIN zonas_cobertura z ON t.idZona = z.idZona
                    WHERE d.idContrato = ?";
    } else {
        $sql_detalles = "SELECT 
                        d.servicio,
                        d.Zona AS zona,
                        DATE_FORMAT(d.fechaServicio, '%d/%m/%Y') AS fechaServicio,
                        d.origen,
                        d.destino,
                        d.peso,
                        d.volumen,
                        d.monto,
                        d.descripcion
                    FROM detalle_contrato_empresa d
                    WHERE d.idContratoempresa = ?";
    }

    $stmt_detalles = $conn->prepare($sql_detalles);
    $stmt_detalles->execute([$id_contrato]);
    $detalles_contrato = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);

    // Crear PDF
    $pdf = new ContratoPDF(
        $config, 
        $datos_contrato, 
        $detalles_contrato, 
        $empresa,
        $datos_contrato['firma_cliente'],
        $terminos_condiciones
    );
    $pdf->AliasNbPages();
    $pdf->generarContrato();

    // Salida del PDF
    $nombre_archivo = 'contrato_' . ($tipo_contrato === 'Natural' ? 'natural_' : 'empresa_') . $id_contrato . '.pdf';
    $pdf->Output('D', $nombre_archivo);

} catch(PDOException $e) {
    die("Error al generar el contrato: " . $e->getMessage());
}
?>