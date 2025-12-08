<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => null];

try {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM servicios WHERE idServicio = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $servicio = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($servicio) {
            $response['success'] = true;
            $response['data'] = $servicio;
        } else {
            $response['message'] = 'Servicio no encontrado';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>