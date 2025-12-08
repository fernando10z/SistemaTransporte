<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID de empresa no proporcionado');
    }

    $idEmpresa = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT ce.*, tr.descripcion AS tipoRuc 
        FROM clientes_empresas ce
        JOIN tipo_ruc tr ON ce.idTipoRuc = tr.idTipoRuc
        WHERE ce.idEmpresa = ?
    ");
    $stmt->execute([$idEmpresa]);
    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($empresa) {
        $response['success'] = true;
        $response['data'] = $empresa;
    } else {
        throw new Exception('Empresa no encontrada');
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>