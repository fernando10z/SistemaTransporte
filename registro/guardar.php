<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        $stmt = $conn->prepare("INSERT INTO registrarcurso 
                              (idCurso, idConductor, fechaInicio, fechaFinal, Observacion, estado) 
                              VALUES 
                              (:idCurso, :idConductor, :fechaInicio, :fechaFinal, :Observacion, 'Activado')");
        
        $stmt->bindParam(':idCurso', $data['idCurso']);
        $stmt->bindParam(':idConductor', $data['idConductor']);
        $stmt->bindParam(':fechaInicio', $data['fechaInicio']);
        $stmt->bindParam(':fechaFinal', $data['fechaFinal']);
        $stmt->bindParam(':Observacion', $data['Observacion']);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Registro de curso guardado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al guardar el registro']);
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