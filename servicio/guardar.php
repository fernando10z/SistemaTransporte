<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombreServicio = $_POST['nombreServicio'];
        $descripcion = $_POST['descripcion'];
        $tipoCarga = $_POST['tipoCarga'];
        $Estado = $_POST['Estado'];

        // Insertar nuevo servicio
        $sql = "INSERT INTO servicios (nombreServicio, descripcion, tipoCarga, Estado) 
                VALUES (:nombreServicio, :descripcion, :tipoCarga, :Estado)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nombreServicio', $nombreServicio);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tipoCarga', $tipoCarga);
        $stmt->bindParam(':Estado', $Estado);
        
        $stmt->execute();
        
        $response['success'] = true;
        $response['message'] = 'Servicio creado correctamente';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>