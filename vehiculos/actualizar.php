<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar y obtener datos del formulario
    $idVehiculo = intval($_POST['idVehiculo'] ?? 0);
    $placa = trim($_POST['placa'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $capacidadPeso = floatval($_POST['capacidadPeso'] ?? 0);
    $capacidadVolumen = floatval($_POST['capacidadVolumen'] ?? 0);
    $monto = floatval($_POST['monto'] ?? 0);
    $estado = trim($_POST['estado'] ?? 'Disponible');
    $idZona = intval($_POST['idZona'] ?? 0);

    // Validaciones básicas
    if ($idVehiculo <= 0) {
        throw new Exception("ID de vehículo no válido");
    }
    if (empty($placa)) {
        throw new Exception("La placa es obligatoria");
    }
    if (empty($marca)) {
        throw new Exception("La marca es obligatoria");
    }
    if ($capacidadPeso <= 0) {
        throw new Exception("La capacidad de peso debe ser mayor que cero");
    }
    if ($capacidadVolumen <= 0) {
        throw new Exception("La capacidad de volumen debe ser mayor que cero");
    }
    if ($monto <= 0) {
        throw new Exception("El monto debe ser mayor que cero");
    }
    if ($idZona <= 0) {
        throw new Exception("Debe seleccionar una zona de cobertura válida");
    }

    // Verificar que el vehículo existe
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM vehiculos WHERE idVehiculo = :idVehiculo");
    $stmtCheck->bindParam(':idVehiculo', $idVehiculo, PDO::PARAM_INT);
    $stmtCheck->execute();
    
    if ($stmtCheck->fetchColumn() == 0) {
        throw new Exception("El vehículo no existe");
    }
  // Verificar si la placa ya existe
    
    // Verificar que la zona existe
    $stmtZona = $conn->prepare("SELECT COUNT(*) FROM zonas_cobertura WHERE idZona = :idZona");
    $stmtZona->bindParam(':idZona', $idZona, PDO::PARAM_INT);
    $stmtZona->execute();
    
    if ($stmtZona->fetchColumn() == 0) {
        throw new Exception("La zona seleccionada no existe");
    }

    // Preparar la consulta SQL de actualización
    $sql = "UPDATE vehiculos SET 
            placa = :placa,
            marca = :marca,
            modelo = :modelo,
            capacidadPeso = :capacidadPeso,
            capacidadVolumen = :capacidadVolumen,
            monto = :monto,
            estado = :estado,
            idZona = :idZona
            WHERE idVehiculo = :idVehiculo";
    
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':placa', $placa);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':capacidadPeso', $capacidadPeso);
    $stmt->bindParam(':capacidadVolumen', $capacidadVolumen);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':idZona', $idZona, PDO::PARAM_INT);
    $stmt->bindParam(':idVehiculo', $idVehiculo, PDO::PARAM_INT);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Vehículo actualizado correctamente',
            'data' => [
                'idVehiculo' => $idVehiculo,
                'placa' => $placa,
                'marca' => $marca
            ]
        ]);
    } else {
        throw new Exception("Error al actualizar el vehículo");
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage(),
        'error_code' => $e->getCode()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 400
    ]);
}
?>