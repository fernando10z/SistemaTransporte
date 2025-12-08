<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => null];

try {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM zonas_cobertura WHERE idZona = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $zona = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($zona) {
            $response['success'] = true;
            $response['data'] = $zona;
        } else {
            $response['message'] = 'Zona no encontrada';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>