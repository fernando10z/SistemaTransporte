<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idZona = $_POST['idZona'];
        $nombreZona = $_POST['nombreZona'];
        $departamento = $_POST['departamento'];
        $provincia = $_POST['provincia'];
        $distrito = $_POST['distrito'];
        $descripcion = $_POST['descripcion'];
        $Estado = $_POST['Estado'];

        $sql = "UPDATE zonas_cobertura SET 
                nombreZona = :nombreZona,
                departamento = :departamento,
                provincia = :provincia,
                distrito = :distrito,
                descripcion = :descripcion,
                Estado = :Estado
                WHERE idZona = :idZona";
                
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':idZona', $idZona);
        $stmt->bindParam(':nombreZona', $nombreZona);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':distrito', $distrito);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':Estado', $Estado);
        
        if($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Zona actualizada correctamente';
        } else {
            $response['message'] = 'Error al actualizar la zona';
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>