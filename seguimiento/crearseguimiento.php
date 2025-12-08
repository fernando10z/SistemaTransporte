<?php
require_once '../conexion/conexion.php';

$idAsignacion = $_POST['idAsignacion'];
$tipoAsignacion = $_POST['tipoAsignacion'];

try {
    if ($tipoAsignacion === 'cliente') {
        // Buscar si ya existe
        $sqlCheck = "SELECT codigoSeguimiento FROM seguimiento_envioclientes WHERE idAsignacion = ?";
    } else {
        // Para empresa
        $sqlCheck = "SELECT codigoSeguimiento FROM seguimiento_envioempresa WHERE idAsignacionEmpresa = ?";
    }

    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute([$idAsignacion]);
    $existing = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Ya existe seguimiento
        echo json_encode(['success' => true, 'codigoSeguimiento' => $existing['codigoSeguimiento']]);
        exit;
    }

    // Si no existe, crear uno nuevo
    $codigoSeguimiento = uniqid('TRACK', true);

    if ($tipoAsignacion === 'cliente') {
        $sqlInsert = "INSERT INTO seguimiento_envioclientes (idAsignacion, codigoSeguimiento, estadoEnvio) 
                      VALUES (?, ?, 'En tránsito')";
    } else {
        $sqlInsert = "INSERT INTO seguimiento_envioempresa (idAsignacionEmpresa, codigoSeguimiento, estadoEnvio) 
                      VALUES (?, ?, 'En tránsito')";
    }

    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->execute([$idAsignacion, $codigoSeguimiento]);

    echo json_encode(['success' => true, 'codigoSeguimiento' => $codigoSeguimiento]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
