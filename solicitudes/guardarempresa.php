<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Obtener datos del formulario
    $idEmpresa = $_POST['idClienteEmpresa'] ?? null;
    $tipoCarga = $_POST['tipoCarga'] ?? null;
    $peso = $_POST['peso'] ?? null;
    $volumen = $_POST['volumen'] ?? null;
    $origen = $_POST['origen'] ?? null;
    $destino = $_POST['destino'] ?? null;
    $fechaEnvio = $_POST['fechaEnvio'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;

    // Validar datos requeridos
    if (!$idEmpresa || !$tipoCarga || !$origen || !$destino || !$fechaEnvio) {
        throw new Exception("Faltan datos requeridos");
    }

    // Generar código de seguimiento único
    $codigoSeguimiento = 'EMP-' . strtoupper(uniqid());

    // Insertar la solicitud en la base de datos
    $stmt = $conn->prepare("INSERT INTO solicitud_empresa 
                            (idEmpresa, tipo_carga, peso, volumen, origen, destino, estado, codigo_seguimiento, fecha_solicitud, observaciones) 
                            VALUES 
                            (:idEmpresa, :tipoCarga, :peso, :volumen, :origen, :destino, 'pendiente', :codigoSeguimiento, NOW(), :descripcion)");

    $stmt->bindParam(':idEmpresa', $idEmpresa);
    $stmt->bindParam(':tipoCarga', $tipoCarga);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':volumen', $volumen);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':codigoSeguimiento', $codigoSeguimiento);
    $stmt->bindParam(':descripcion', $descripcion);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Solicitud registrada correctamente para la empresa',
            'idSolicitud' => $conn->lastInsertId(),
            'codigoSeguimiento' => $codigoSeguimiento
        ]);
    } else {
        throw new Exception("Error al guardar la solicitud");
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>