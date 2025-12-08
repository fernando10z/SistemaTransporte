<?php
// generar_excel_historial.php
require('../conexion/conexion.php');

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

// Determinar el rango de fechas para el título del Excel
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

// Configurar headers para Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="Historial_Asistencia_' . 
       str_replace(' ', '_', $infoConductor['nombre']) . '_' . 
       ($fechaDesde ? str_replace('-', '', $fechaDesde) : '') . 
       ($fechaHasta ? '_' . str_replace('-', '', $fechaHasta) : '') . 
       '_' . date('Ymd_His') . '.xls"');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');

// Inicio del documento Excel
echo "<!DOCTYPE html>
<html xmlns:o='urn:schemas-microsoft-com:office:office'
      xmlns:x='urn:schemas-microsoft-com:office:excel'
      xmlns='http://www.w3.org/TR/REC-html40'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Historial de Asistencia</title>
    <style>
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        th { font-weight: bold; background-color: #2c3c69; color: white; }
        .bg-ingreso { background-color: #28a745; color: white; }
        .bg-ausente { background-color: #dc3545; color: white; }
        .bg-justificado { background-color: #17a2b8; color: white; }
        .bg-descanso { background-color: #6f42c1; color: white; }
        .filtros { background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 10px; margin-bottom: 15px; }
        .titulo { font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>
<table border='1'>
    <tr>
        <th colspan='8' style='background-color: #2c3c69; color: white;' class='titulo'>HISTORIAL DE ASISTENCIA</th>
    </tr>
    <tr>
        <th colspan='2'>Conductor:</th>
        <td colspan='6'>" . htmlspecialchars($infoConductor['nombre'] . ' ' . $infoConductor['Apepat'] . ' ' . $infoConductor['Apemat']) . "</td>
    </tr>
    <tr>
        <th colspan='2'>Documento:</th>
        <td colspan='6'>" . htmlspecialchars($infoConductor['tipoDocumento'] . ' - ' . $infoConductor['documento']) . "</td>
    </tr>
    <tr>
        <th colspan='2'>Licencia:</th>
        <td colspan='6'>" . htmlspecialchars($infoConductor['tipoLicencia'] . ' (' . $infoConductor['licencia'] . ')') . "</td>
    </tr>
    <tr>
        <th colspan='2'>Período:</th>
        <td colspan='6'>";

// Mostrar el período según los filtros
if ($fechaInicio && $fechaFin) {
    if ($fechaInicio == $fechaFin) {
        echo $fechaInicio->format('d/m/Y');
    } else {
        echo $fechaInicio->format('d/m/Y') . ' - ' . $fechaFin->format('d/m/Y');
    }
} else {
    echo "Todo el historial disponible";
}

echo "</td>
    </tr>";

// Mostrar filtros aplicados
echo "<tr>
        <td colspan='8' class='filtros'>
            <strong>Filtros aplicados:</strong> ";

if (!empty($fechaDesde) || !empty($fechaHasta)) {
    if (!empty($fechaDesde) && !empty($fechaHasta)) {
        echo "Rango de fechas: " . date('d/m/Y', strtotime($fechaDesde)) . " al " . date('d/m/Y', strtotime($fechaHasta)) . " | ";
    } elseif (!empty($fechaDesde)) {
        echo "Desde: " . date('d/m/Y', strtotime($fechaDesde)) . " | ";
    } elseif (!empty($fechaHasta)) {
        echo "Hasta: " . date('d/m/Y', strtotime($fechaHasta)) . " | ";
    }
}

if (!empty($busqueda)) {
    echo "Búsqueda: \"" . htmlspecialchars($busqueda) . "\" | ";
}

if (empty($fechaDesde) && empty($fechaHasta) && empty($busqueda)) {
    echo "Ningún filtro aplicado";
}

echo "</td>
      </tr>";

echo "<tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Día</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Horas</th>
        <th>Observaciones</th>
        <th>Estado</th>
    </tr>";

$totalHoras = 0;
foreach ($historial as $index => $asistencia) {
    $estado = strtolower($asistencia['estado'] ?? 'ingreso');
    
    echo "<tr>
            <td class='text-center'>" . ($index + 1) . "</td>
            <td class='text-center'>" . htmlspecialchars(date('d/m/Y', strtotime($asistencia['fecha_registro']))) . "</td>
            <td class='text-center'>" . htmlspecialchars($asistencia['dia'] ?? '--') . "</td>
            <td class='text-center'>" . htmlspecialchars($asistencia['hora_entrada'] ?? '-') . "</td>
            <td class='text-center'>" . htmlspecialchars($asistencia['hora_salida'] ?? '-') . "</td>
            <td class='text-center'>" . htmlspecialchars($asistencia['horas_conducidas'] ?? '0') . " hrs</td>
            <td class='text-left'>" . htmlspecialchars($asistencia['observaciones'] ?? '--') . "</td>
            <td class='text-center bg-{$estado}'>" . htmlspecialchars(ucfirst($estado)) . "</td>
          </tr>";
    
    $totalHoras += floatval($asistencia['horas_conducidas'] ?? 0);
}

echo "<tr>
        <td colspan='5' class='text-right'><strong>TOTAL HORAS:</strong></td>
        <td class='text-center'><strong>" . number_format($totalHoras, 2) . " hrs</strong></td>
        <td colspan='2'></td>
      </tr>";

echo "</table>
<div style='margin-top: 20px; text-align: right; font-style: italic;'>
    Generado el " . date('d/m/Y H:i:s') . "
</div>
</body>
</html>";
exit();