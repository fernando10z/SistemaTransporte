<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        echo json_encode(['exists' => false, 'error' => 'ID de conductor no proporcionado']);
        exit;
    }

    $idConductor = $_GET['id'];
    
    // Verificar que el conductor existe y está activo
    $stmt = $conn->prepare("SELECT idConductor FROM conductores WHERE idConductor = ? AND estado = 'Activo'");
    $stmt->execute([$idConductor]);
    
    echo json_encode(['exists' => $stmt->rowCount() > 0]);
    
} catch (PDOException $e) {
    echo json_encode(['exists' => false, 'error' => $e->getMessage()]);
}
?>