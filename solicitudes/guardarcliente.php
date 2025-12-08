<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Obtener datos del formulario
    $idCliente = $_POST['idClienteEmpresa'] ?? null;
    $tipoCarga = $_POST['tipoCarga'] ?? null;
    $peso = $_POST['peso'] ?? null;
    $volumen = $_POST['volumen'] ?? null;
    $origen = $_POST['origen'] ?? null;
    $destino = $_POST['destino'] ?? null;
    $fechaEnvio = $_POST['fechaEnvio'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;

    // Validar datos requeridos
    if (!$idCliente || !$tipoCarga || !$origen || !$destino || !$fechaEnvio) {
        throw new Exception("Faltan datos requeridos");
    }

    // Insertar la solicitud en la base de datos
    $stmt = $conn->prepare("INSERT INTO solicitudes_clientes 
                            (idCliente, tipoCarga, peso, volumen, origen, destino, fechaEnvio, descripcion, estado) 
                            VALUES 
                            (:idCliente, :tipoCarga, :peso, :volumen, :origen, :destino, :fechaEnvio, :descripcion, 'Pendiente')");

    $stmt->bindParam(':idCliente', $idCliente);
    $stmt->bindParam(':tipoCarga', $tipoCarga);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':volumen', $volumen);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':fechaEnvio', $fechaEnvio);
    $stmt->bindParam(':descripcion', $descripcion);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Solicitud registrada correctamente para el cliente natural',
            'idSolicitud' => $conn->lastInsertId()
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