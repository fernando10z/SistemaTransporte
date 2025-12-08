<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID no proporcionado');
    }

    $id = $_GET['id'];
    
    // Verificar conexión
    if (!$conn) {
        throw new Exception('Error de conexión a la base de datos');
    }

    $conn->beginTransaction();
    
    // Eliminar código QR primero
    $stmt = $conn->prepare("DELETE FROM codigo_qr_conductores WHERE idConductor = ?");
    if (!$stmt->execute([$id])) {
        throw new Exception('Error al eliminar código QR');
    }
    
    // Luego eliminar conductor
    $stmt = $conn->prepare("DELETE FROM conductores WHERE idConductor = ?");
    if (!$stmt->execute([$id])) {
        throw new Exception('Error al eliminar conductor');
    }
    
    $conn->commit();
    
    echo json_encode(['success' => true, 'message' => 'Eliminación exitosa']);
    
} catch (PDOException $e) {
    if (isset($conn)) {
        $conn->rollBack();
    }
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => 'Error PDO: ' . $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => $e->getMessage()
    ]);
}
?>