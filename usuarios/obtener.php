<?php
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    $idUsuario = $_POST['idUsuario'];
    
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idUsuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        $response['success'] = true;
        $response['data'] = $usuario;
    } else {
        $response['message'] = 'Usuario no encontrado';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>