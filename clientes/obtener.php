<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    $id = $_POST['id'] ?? 0;
    $tipo = $_POST['tipo'] ?? '';
    
    if (!$id || !$tipo) {
        throw new Exception('Parámetros inválidos');
    }

    if ($tipo === 'Natural') {
        $sql = "SELECT * FROM clientes_naturales WHERE idCliente = ?";
    } else {
        $sql = "SELECT * FROM clientes_empresas WHERE idEmpresa = ?";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($cliente) {
        // Asegurar que el campo firmas siempre esté presente
        $cliente['firmas'] = $cliente['firmas'] ?? null;
        
        // Construir ruta completa de la firma si existe
        if ($cliente['firmas']) {
            $cliente['firma_url'] = '../uploads/firmas/' . $cliente['firmas'];
        }
        
        $response['success'] = true;
        $response['data'] = $cliente;
    } else {
        throw new Exception('Cliente no encontrado');
    }
} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>