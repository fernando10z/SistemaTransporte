<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID de cliente no proporcionado');
    }

    $idCliente = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT cn.*, td.tipoDocumento 
        FROM clientes_naturales cn
        JOIN tipodocumento td ON cn.idTipoDocumento = td.idTipoDocumento
        WHERE cn.idCliente = ?
    ");
    $stmt->execute([$idCliente]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $response['success'] = true;
        $response['data'] = $cliente;
    } else {
        throw new Exception('Cliente no encontrado');
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>