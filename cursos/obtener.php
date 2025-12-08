<?php
require '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $idCurso = $_GET['id'];
    
    try {
        $stmt = $conn->prepare("SELECT * FROM cursos_conductor WHERE idCurso = :id");
        $stmt->bindParam(':id', $idCurso);
        $stmt->execute();
        
        $curso = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($curso) {
            header('Content-Type: application/json');
            echo json_encode($curso);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Curso no encontrado']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al obtener el curso: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID de curso no proporcionado']);
}
?>