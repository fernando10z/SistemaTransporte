<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$licencia = $_POST['licencia'] ?? '';

try {
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM conductores 
                           WHERE licencia = :licencia");
    $stmt->bindParam(':licencia', $licencia);
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