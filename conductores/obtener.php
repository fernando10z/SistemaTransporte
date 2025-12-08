<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$idConductor = $_POST['idConductor'] ?? null;

try {
    if (!$idConductor) {
        throw new Exception('ID de conductor no proporcionado');
    }

    $stmt = $conn->prepare("SELECT * FROM conductores WHERE idConductor = :idConductor");
    $stmt->bindParam(':idConductor', $idConductor);
    $stmt->execute();
    
    $conductor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$conductor) {
        throw new Exception('Conductor no encontrado');
    }
    
    echo json_encode([
        'success' => true,
        'data' => $conductor
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>