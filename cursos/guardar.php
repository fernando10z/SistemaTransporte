<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => '',
    'error' => ''
];

try {
    // Validar datos recibidos
    if (empty($_POST['nombre_curso'])) {
        throw new Exception('El nombre del curso es obligatorio');
    }
    
    if (empty($_POST['entidad'])) {
        throw new Exception('La entidad certificadora es obligatoria');
    }
    
    if (empty($_POST['descripcion'])) {
        throw new Exception('La descripción del curso es obligatoria');
    }

    // Preparar consulta SQL
    $sql = "INSERT INTO cursos_conductor (nombre_curso, entidad, descripcion, estado) 
            VALUES (:nombre_curso, :entidad, :descripcion, :estado)";
    
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':nombre_curso', $_POST['nombre_curso']);
    $stmt->bindParam(':entidad', $_POST['entidad']);
    $stmt->bindParam(':descripcion', $_POST['descripcion']);
     $stmt->bindParam(':estado', $_POST['estado']);
    
    // Ejecutar consulta
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Curso creado exitosamente';
    } else {
        $errorInfo = $stmt->errorInfo();
        throw new Exception('Error al guardar el curso: ' . $errorInfo[2]);
    }
    
} catch (PDOException $e) {
    $response['error'] = 'Error de base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

// Devolver respuesta JSON
echo json_encode($response);
?>