<?php
require_once '../conexion/conexion.php';

$search = $_GET['search'] ?? '';

try {
    $sql = "SELECT idCliente, nombre, apellidopat, apellidoMat, numerodocumento, telefono, correo, status 
            FROM clientes_naturales 
            WHERE status = 'Activo' AND (nombre LIKE :search OR apellidopat LIKE :search OR apellidoMat LIKE :search OR numerodocumento LIKE :search)";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($clientes);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>