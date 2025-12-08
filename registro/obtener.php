<?php
require '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $conn->prepare("SELECT rc.*, 
                              c.nombre as nombre_conductor, 
                              c.Apepat, c.Apemat,
                              cs.nombre_curso
                              FROM registrarcurso rc
                              JOIN conductores c ON rc.idConductor = c.idConductor
                              JOIN cursos_conductor cs ON rc.idCurso = cs.idCurso
                              WHERE rc.idregistrar = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($registro) {
            header('Content-Type: application/json');
            echo json_encode($registro);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Registro no encontrado']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al obtener el registro: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>