<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['existe' => false];

try {
    $tipoDocumento = $_POST['tipoDocumento'] ?? '';
    $numeroDocumento = $_POST['numeroDocumento'] ?? '';
    
    if ($tipoDocumento && $numeroDocumento) {
        $stmt = $conn->prepare("SELECT idCliente FROM clientes_naturales WHERE idTipoDocumento = ? AND numerodocumento = ?");
        $stmt->execute([$tipoDocumento, $numeroDocumento]);
        $response['existe'] = $stmt->fetch() !== false;
    }
} catch (PDOException $e) {
    // Registrar error si es necesario
}

echo json_encode($response);
?>