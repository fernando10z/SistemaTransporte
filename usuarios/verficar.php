<?php
require_once '../conexion/conexion.php';

$response = ['existe' => false];

try {
    $idTipoDocumento = $_POST['idTipoDocumento'];
    $numerodocumento = $_POST['numerodocumento'];
    $idUsuario = $_POST['idUsuario'] ?? 0;

    $sql = "SELECT COUNT(*) as total FROM usuarios 
            WHERE idTipoDocumento = ? AND numerodocumento = ? AND idUsuario != ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idTipoDocumento, $numerodocumento, $idUsuario]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        $response['existe'] = true;
    }
} catch (PDOException $e) {
    // En caso de error, asumimos que el documento existe para evitar duplicados
    $response['existe'] = true;
}

header('Content-Type: application/json');
echo json_encode($response);
?>