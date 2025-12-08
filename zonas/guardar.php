<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombreZona = $_POST['nombreZona'];
        $departamento = $_POST['departamento'];
        $provincia = $_POST['provincia'];
        $distrito = $_POST['distrito'];
        $descripcion = $_POST['descripcion'];
        $Estado = $_POST['Estado'];

        // Insertar nueva zona
        $sql = "INSERT INTO zonas_cobertura (nombreZona, departamento, provincia, distrito, descripcion, Estado) 
                VALUES (:nombreZona, :departamento, :provincia, :distrito, :descripcion, :Estado)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nombreZona', $nombreZona);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':distrito', $distrito);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':Estado', $Estado);
        
        if($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Zona registrada correctamente';
        } else {
            $response['message'] = 'Error al registrar la zona';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>