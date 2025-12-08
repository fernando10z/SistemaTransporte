<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        // Validar datos
        if (empty($data['idregistrar']) || !isset($data['nota']) || empty($data['estado'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
            exit;
        }
        
        // Validar nota entre 1 y 20
        $nota = intval($data['nota']);
        if ($nota < 1 || $nota > 20) {
            http_response_code(400);
            echo json_encode(['error' => 'La nota debe estar entre 1 y 20']);
            exit;
        }
        
        $stmt = $conn->prepare("INSERT INTO desempeno 
                              (idregistrar, nota, estado, observaciones) 
                              VALUES 
                              (:idregistrar, :nota, :estado, :observaciones)");
        
        $stmt->bindParam(':idregistrar', $data['idregistrar']);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':observaciones', $data['observaciones']);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Desempeño registrado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al guardar el desempeño']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>