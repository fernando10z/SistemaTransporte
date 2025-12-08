<?php
require '../conexion/conexion.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT idCurso, nombre_curso, entidad 
           FROM cursos_conductor 
           WHERE estado = 'Activado' 
           AND (nombre_curso LIKE :search OR entidad LIKE :search)
           LIMIT 10";
           
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    
    $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($cursos);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la búsqueda: ' . $e->getMessage()]);
}
?>