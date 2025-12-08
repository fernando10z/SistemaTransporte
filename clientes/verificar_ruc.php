<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['existe' => false];

try {
    $ruc = $_POST['ruc'] ?? '';
    
    if ($ruc) {
        $stmt = $conn->prepare("SELECT idEmpresa FROM clientes_empresas WHERE ruc = ?");
        $stmt->execute([$ruc]);
        $response['existe'] = $stmt->fetch() !== false;
    }
} catch (PDOException $e) {
    // Registrar error si es necesario
}

echo json_encode($response);
?>