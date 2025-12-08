<?php
require_once '../conexion/conexion.php';

$search = $_GET['search'] ?? '';

try {
    $sql = "SELECT idEmpresa, razonSocial, ruc, telefono, correo, status 
            FROM clientes_empresas 
            WHERE status = 'Activo' AND (razonSocial LIKE :search OR ruc LIKE :search)";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    
    $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($empresas);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>