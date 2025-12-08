<?php
require('../fpdf/fpdf.php');
require('../conexion/conexion.php');
date_default_timezone_set('America/Lima');

// Función para convertir texto a UTF-8
function utf8($text) {
    return iconv('UTF-8', 'windows-1252', $text);
}

if (!isset($_GET['id'])) {
    die("ID de seguro no especificado");
}

$idSeguro = $_GET['id'];

// 1. Actualizar estado del seguro a "Realizada"
try {
    $sql_update = "UPDATE seguros_vehiculo SET estado = 'Realizada' WHERE idSeguro = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->execute([$idSeguro]);
} catch(PDOException $e) {
    die("Error al actualizar el estado: " . $e->getMessage());
}

// 2. Obtener información del seguro y vehículo
try {
    $sql = "SELECT s.*, v.placa, v.marca, v.modelo 
            FROM seguros_vehiculo s
            JOIN vehiculos v ON s.idVehiculo = v.idVehiculo
            WHERE s.idSeguro = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idSeguro]);
    $seguro = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$seguro) {
        die("No se encontró el seguro especificado");
    }
} catch(PDOException $e) {
    die("Error al obtener información del seguro: " . $e->getMessage());
}

// 3. Obtener información de la empresa
try {
    $sql_empresa = "SELECT nombre_empresa, ruc, direccion, telefono, logo, firmas 
                   FROM configuracion_empresa 
                   ORDER BY id_configuracion DESC LIMIT 1";
    $stmt_empresa = $conn->query($sql_empresa);
    $empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);
    
    if (!$empresa) {
        $empresa = [
            'nombre_empresa' => 'EMPRESA DE TRANSPORTES',
            'ruc' => 'RUC 12345678901',
            'direccion' => 'Av. Principal 123 - Lima',
            'telefono' => 'Tel: (01) 123-4567',
            'logo' => null,
            'firmas' => null
        ];
    }
} catch(PDOException $e) {
    die("Error al obtener información de la empresa: " . $e->getMessage());
}

class SeguroPDF extends FPDF {
    private $seguro;
    private $empresa;
    
    function __construct($seguro, $empresa, $orientation='P', $unit='mm', $size='A4') {
        parent::__construct($orientation, $unit, $size);
        $this->seguro = $seguro;
        $this->empresa = $empresa;
        $this->SetLeftMargin(15);
        $this->SetRightMargin(15);
        $this->SetAutoPageBreak(true, 25);
    }
    
    function Header() {
        // Logo de la empresa
        if (!empty($this->empresa['logo'])) {
            $logo_path = '../configuracion/empresa/' . $this->empresa['logo'];
            if (file_exists($logo_path)) {
                $this->Image($logo_path, 15, 10, 25);
            }
        }
        
        // Información de la empresa (alineado a la derecha del logo)
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(13, 71, 161); // Azul oscuro
        $this->SetXY(45, 10);
        $this->Cell(0, 6, utf8($this->empresa['nombre_empresa']), 0, 1);
        
        $this->SetFont('Arial', '', 9);
        $this->SetXY(45, 16);
        $this->Cell(0, 5, utf8($this->empresa['ruc']), 0, 1);
        $this->SetXY(45, 21);
        $this->Cell(0, 5, utf8($this->empresa['direccion']), 0, 1);
        $this->SetXY(45, 26);
        $this->Cell(0, 5, utf8($this->empresa['telefono']), 0, 1);
        
        // Línea divisoria con color
        $this->SetDrawColor(13, 71, 161);
        $this->SetLineWidth(0.5);
        $this->Line(15, 35, $this->GetPageWidth()-15, 35);
        
        // Título del documento
        $this->SetY(40);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(220, 53, 69); // Rojo
        $this->Cell(0, 10, utf8('CERTIFICADO DE COBERTURA'), 0, 1, 'C');
        
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 8, utf8('SEGURO DE VEHÍCULOS'), 0, 1, 'C');
        $this->Ln(5);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100);
        $this->Cell(0, 5, utf8('Documento generado el ' . date('d/m/Y H:i')), 0, 0, 'C');
        $this->Ln();
        $this->Cell(0, 5, utf8('Página '.$this->PageNo().'/{nb}'), 0, 0, 'C');
    }
    
    function generarCertificado() {
        $this->AddPage();
        $this->SetFont('Arial', '', 11);
        
        // Marco para los datos principales
        $this->SetDrawColor(200);
        $this->SetFillColor(245, 245, 245);
        $this->RoundedRect(15, $this->GetY(), $this->GetPageWidth()-30, 30, 5, 'DF');
        
        // Datos principales
        $this->SetY($this->GetY()+5);
        $this->SetFont('', 'B');
        $this->Cell(40, 8, utf8('PÓLIZA N°:'), 0, 0);
        $this->SetFont('', '');
        $this->Cell(50, 8, utf8($this->seguro['numero_poliza']), 0, 0);
        
        $this->SetFont('', 'B');
        $this->Cell(30, 8, utf8('CÓDIGO:'), 0, 0);
        $this->SetFont('', '');
        $this->Cell(0, 8, utf8($this->seguro['codigo']), 0, 1);
        
        // Vigencia
        $this->SetFont('', 'B');
        $this->Cell(40, 8, utf8('VIGENCIA:'), 0, 0);
        $this->SetFont('', '');
        $fechaInicio = date('d/m/Y', strtotime($this->seguro['fecha_inicio']));
        $fechaFin = date('d/m/Y', strtotime($this->seguro['fecha_vencimiento']));
        $this->Cell(0, 8, utf8("Desde $fechaInicio hasta $fechaFin"), 0, 1);
        $this->Ln(10);
        
        // Vehículo asegurado (con marco)
        $this->SetDrawColor(200);
        $this->SetFillColor(245, 245, 245);
        $this->RoundedRect(15, $this->GetY(), $this->GetPageWidth()-30, 40, 5, 'DF');
        
        $this->SetY($this->GetY()+5);
        $this->SetFont('', 'B');
        $this->Cell(0, 8, utf8('VEHÍCULO ASEGURADO'), 0, 1);
        $this->SetFont('', '');
        
        $this->Cell(40, 8, utf8('Placa:'), 0, 0);
        $this->Cell(50, 8, utf8($this->seguro['placa']), 0, 0);
        
        $this->Cell(40, 8, utf8('Marca:'), 0, 0);
        $this->Cell(0, 8, utf8($this->seguro['marca']), 0, 1);
        
        $this->Cell(40, 8, utf8('Modelo:'), 0, 0);
        $this->Cell(0, 8, utf8($this->seguro['modelo']), 0, 1);
        $this->Ln(10);
        
        // Coberturas (con marco)
        $this->SetDrawColor(200);
        $this->SetFillColor(245, 245, 245);
        $this->RoundedRect(15, $this->GetY(), $this->GetPageWidth()-30, 30, 5, 'DF');
        
        $this->SetY($this->GetY()+5);
        $this->SetFont('', 'B');
        $this->Cell(0, 8, utf8('COBERTURAS:'), 0, 1);
        $this->SetFont('', '');
        $this->MultiCell(0, 6, utf8($this->seguro['nombre_seguro']));
        $this->Ln(5);
        
        // Observaciones (si existe)
        if (!empty($this->seguro['observaciones'])) {
            $this->SetDrawColor(200);
            $this->SetFillColor(245, 245, 245);
            $this->RoundedRect(15, $this->GetY(), $this->GetPageWidth()-30, 30, 5, 'DF');
            
            $this->SetY($this->GetY()+5);
            $this->SetFont('', 'B');
            $this->Cell(0, 8, utf8('OBSERVACIONES:'), 0, 1);
            $this->SetFont('', '');
            $this->MultiCell(0, 6, utf8($this->seguro['observaciones']));
            $this->Ln(5);
        }
        
        // Estado (pequeño recuadro)
        $this->SetDrawColor(200);
        $this->SetFillColor(245, 245, 245);
        $this->RoundedRect(15, $this->GetY(), $this->GetPageWidth()-30, 15, 5, 'DF');
        
        $this->SetY($this->GetY()+5);
        $this->SetFont('', 'B');
        $this->Cell(40, 8, utf8('ESTADO:'), 0, 0);
        $this->SetFont('', '');
        $this->Cell(0, 8, utf8($this->seguro['estado']), 0, 1);
        $this->Ln(15);
        
        // Firma y sello
        $this->Cell(0, 8, utf8('Fecha: ' . date('d/m/Y')), 0, 1, 'R');
        $this->Ln(10);
        
        // Posición de la firma
        $firmaY = $this->GetY();
        
        // Imagen de firma si existe
        if (!empty($this->empresa['firmas'])) {
            $firma_path = '../configuracion/empresa/' . $this->empresa['firmas'];
            if (file_exists($firma_path)) {
                $this->Image($firma_path, $this->GetPageWidth()/2 - 20, $firmaY, 40);
                $firmaY += 30; // Ajustar posición del texto después de la imagen
            }
        }
        
        // Línea de firma
        $this->SetLineWidth(0.5);
        $this->Line($this->GetPageWidth()/2 - 40, $firmaY, $this->GetPageWidth()/2 + 40, $firmaY);
        
        // Texto de firma
        $this->SetY($firmaY + 5);
        $this->SetFont('', 'B');
        $this->Cell(0, 8, utf8('Representante Legal'), 0, 1, 'C');
        $this->Cell(0, 8, utf8($this->empresa['nombre_empresa']), 0, 1, 'C');
        $this->SetFont('', 'I');
        $this->Cell(0, 8, utf8('RUC: ' . $this->empresa['ruc']), 0, 1, 'C');
    }
    
    // Función para crear rectángulos redondeados
    function RoundedRect($x, $y, $w, $h, $r, $style = '') {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }
    
    function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
}

// Crear PDF
$pdf = new SeguroPDF($seguro, $empresa);
$pdf->AliasNbPages();
$pdf->generarCertificado();

// Salida del PDF
$nombre_archivo = 'seguro_' . $seguro['codigo'] . '.pdf';
$pdf->Output('D', $nombre_archivo);
?>