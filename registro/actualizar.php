<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        $stmt = $conn->prepare("UPDATE registrarcurso SET 
                              idCurso = :idCurso, 
                              idConductor = :idConductor, 
                              fechaInicio = :fechaInicio, 
                              fechaFinal = :fechaFinal, 
                              Observacion = :Observacion, 
                              estado = :estado 
                              WHERE idregistrar = :id");
        
        $stmt->bindParam(':idCurso', $data['idCurso']);
        $stmt->bindParam(':idConductor', $data['idConductor']);
        $stmt->bindParam(':fechaInicio', $data['fechaInicio']);
        $stmt->bindParam(':fechaFinal', $data['fechaFinal']);
        $stmt->bindParam(':Observacion', $data['Observacion']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':id', $data['idregistrar']);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Registro de curso actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el registro']);
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