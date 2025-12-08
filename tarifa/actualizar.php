<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idTarifa = $_POST['idTarifa'];
        $idServicio = $_POST['idServicio'];
        $idZona = $_POST['idZona'];
        $monto = $_POST['monto'];
        $observaciones = $_POST['observaciones'] ?? null;
        $fechaVigencia = !empty($_POST['fechaVigencia']) ? $_POST['fechaVigencia'] : null;
        $Estado = $_POST['Estado'];

        // Validar que no exista otra tarifa igual activa (excepto la actual)
        $sqlCheck = "SELECT idTarifa FROM tarifas 
                    WHERE idServicio = :idServicio 
                    AND idZona = :idZona 
                    AND Estado = 'Activo'
                    AND idTarifa != :idTarifa";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bindParam(':idServicio', $idServicio);
        $stmtCheck->bindParam(':idZona', $idZona);
        $stmtCheck->bindParam(':idTarifa', $idTarifa);
        $stmtCheck->execute();
        
        if($stmtCheck->rowCount() > 0) {
            $response['message'] = 'Ya existe otra tarifa activa para este servicio y zona';
        } else {
            $sql = "UPDATE tarifas SET 
                    idServicio = :idServicio,
                    idZona = :idZona,
                    monto = :monto,
                    observaciones = :observaciones,
                    fechaVigencia = :fechaVigencia,
                    Estado = :Estado
                    WHERE idTarifa = :idTarifa";
                    
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':idTarifa', $idTarifa);
            $stmt->bindParam(':idServicio', $idServicio);
            $stmt->bindParam(':idZona', $idZona);
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->bindParam(':fechaVigencia', $fechaVigencia);
            $stmt->bindParam(':Estado', $Estado);
            
            if($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Tarifa actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la tarifa';
            }
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>