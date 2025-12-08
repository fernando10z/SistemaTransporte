<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['token'])) {
    $idConductor = $_GET['id'];
    $token = $_GET['token'];
    
    try {
        $stmt = $conn->prepare("SELECT 1 FROM codigo_qr_conductores 
                               WHERE idConductor = ? AND token_qr = ? AND estado = 'Activo'");
        $stmt->execute([$idConductor, $token]);
        
        echo json_encode([
            'exists' => $stmt->rowCount() > 0
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'exists' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'exists' => false,
        'error' => 'Parámetros incorrectos'
    ]);
}
?>