<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => null];

try {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        $sql = "SELECT t.*, s.nombreServicio, s.tipoCarga, z.nombreZona, z.departamento, z.provincia, z.distrito 
                FROM tarifas t
                JOIN servicios s ON t.idServicio = s.idServicio
                JOIN zonas_cobertura z ON t.idZona = z.idZona
                WHERE t.idTarifa = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $tarifa = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($tarifa) {
            $response['success'] = true;
            $response['data'] = $tarifa;
        } else {
            $response['message'] = 'Tarifa no encontrada';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>