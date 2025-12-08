<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['idCurso'])) {
        try {
            $stmt = $conn->prepare("UPDATE cursos_conductor SET 
                                  nombre_curso = :nombre_curso, 
                                  entidad = :entidad, 
                                  descripcion = :descripcion, 
                                  estado = :estado 
                                  WHERE idCurso = :id");
            
            $stmt->bindParam(':nombre_curso', $data['nombre_curso']);
            $stmt->bindParam(':entidad', $data['entidad']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':id', $data['idCurso']);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => 'Curso actualizado correctamente']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Error al actualizar el curso']);
            }
        } catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Datos incompletos']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>