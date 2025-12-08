<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idServicio = $_POST['idServicio'];
        $idZona = $_POST['idZona'];
        $monto = $_POST['monto'];
        $observaciones = $_POST['observaciones'] ?? null;
        $fechaVigencia = !empty($_POST['fechaVigencia']) ? $_POST['fechaVigencia'] : null;
        $Estado = $_POST['Estado'];

        // Validar que no exista una tarifa igual activa
        $sqlCheck = "SELECT idTarifa FROM tarifas 
                    WHERE idServicio = :idServicio 
                    AND idZona = :idZona 
                    AND Estado = 'Activo'";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bindParam(':idServicio', $idServicio);
        $stmtCheck->bindParam(':idZona', $idZona);
        $stmtCheck->execute();
        
        if($stmtCheck->rowCount() > 0) {
            $response['message'] = 'Ya existe una tarifa activa para este servicio y zona';
        } else {
            $sql = "INSERT INTO tarifas (idServicio, idZona, monto, observaciones, fechaVigencia, Estado) 
                    VALUES (:idServicio, :idZona, :monto, :observaciones, :fechaVigencia, :Estado)";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':idServicio', $idServicio);
            $stmt->bindParam(':idZona', $idZona);
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->bindParam(':fechaVigencia', $fechaVigencia);
            $stmt->bindParam(':Estado', $Estado);
            
            if($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Tarifa registrada correctamente';
            } else {
                $response['message'] = 'Error al registrar la tarifa';
            }
        }
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>