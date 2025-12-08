<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idSolicitud = $_POST['idSolicitud'] ?? null;
    $tipoSolicitud = $_POST['tipoSolicitud'] ?? null;
    $idClienteEmpresa = $_POST['idClienteEmpresa'] ?? null;
    
    if (!$idSolicitud || !$tipoSolicitud || !$idClienteEmpresa) {
        throw new Exception("Faltan parámetros requeridos");
    }
    
    // Obtener datos del formulario
    $tipoCarga = $_POST['tipoCarga'] ?? null;
    $peso = $_POST['peso'] ?? null;
    $volumen = $_POST['volumen'] ?? null;
    $origen = $_POST['origen'] ?? null;
    $destino = $_POST['destino'] ?? null;
    $fechaEnvio = $_POST['fechaEnvio'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    
    // Validar datos requeridos
    if (!$tipoCarga || !$origen || !$destino || !$fechaEnvio) {
        throw new Exception("Faltan datos requeridos");
    }
    
    // Construir la consulta SQL dinámicamente
    if ($tipoSolicitud === 'Natural') {
        $sql = "UPDATE solicitudes_clientes SET
                    idCliente = :idEntidad,
                    tipoCarga = :tipoCarga,
                    peso = :peso,
                    volumen = :volumen,
                    origen = :origen,
                    destino = :destino,
                    fechaEnvio = :fechaEnvio,
                    descripcion = :descripcion
                WHERE idSolicitud = :id";
    } else {
        $sql = "UPDATE solicitud_empresa SET
                    idEmpresa = :idEntidad,
                    tipo_carga = :tipoCarga,
                    peso = :peso,
                    volumen = :volumen,
                    origen = :origen,
                    destino = :destino,
                    fecha_solicitud = :fechaEnvio,
                    observaciones = :descripcion
                WHERE idSolicitudempresa = :id";
    }
    
    $stmt = $conn->prepare($sql);
    
    // Asignar parámetros
    $stmt->bindParam(':idEntidad', $idClienteEmpresa);
    $stmt->bindParam(':tipoCarga', $tipoCarga);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':volumen', $volumen);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':fechaEnvio', $fechaEnvio);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':id', $idSolicitud);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Solicitud actualizada correctamente'
        ]);
    } else {
        throw new Exception("Error al actualizar la solicitud");
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