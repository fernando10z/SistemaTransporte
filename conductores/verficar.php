<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$idTipoDocumento = $_POST['idTipoDocumento'] ?? '';
$numerodocumento = $_POST['numerodocumento'] ?? '';

try {
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM conductores 
                           WHERE idTipoDocumento = :idTipoDocumento 
                           AND numerodocumento = :numerodocumento");
    $stmt->bindParam(':idTipoDocumento', $idTipoDocumento);
    $stmt->bindParam(':numerodocumento', $numerodocumento);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'existe' => $result['count'] > 0
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'existe' => false,
        'error' => $e->getMessage()
    ]);
}
?>