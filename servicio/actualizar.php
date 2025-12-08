<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idServicio = $_POST['idServicio'];
        $nombreServicio = $_POST['nombreServicio'];
        $descripcion = $_POST['descripcion'];
        $tipoCarga = $_POST['tipoCarga'];
        $Estado = $_POST['Estado'];

        $sql = "UPDATE servicios SET 
                nombreServicio = :nombreServicio,
                descripcion = :descripcion,
                tipoCarga = :tipoCarga,
                Estado = :Estado
                WHERE idServicio = :idServicio";
                
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':idServicio', $idServicio);
        $stmt->bindParam(':nombreServicio', $nombreServicio);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tipoCarga', $tipoCarga);
        $stmt->bindParam(':Estado', $Estado);
        
        if($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Servicio actualizado correctamente';
        } else {
            $response['message'] = 'Error al actualizar el servicio';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>