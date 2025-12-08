<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar y obtener datos del formulario
    $placa = trim($_POST['placa'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $capacidadPeso = floatval($_POST['capacidadPeso'] ?? 0);
    $capacidadVolumen = floatval($_POST['capacidadVolumen'] ?? 0);
    $monto = floatval($_POST['Monto'] ?? 0);
    $estado = trim($_POST['estado'] ?? 'Disponible');
    $idZona = intval($_POST['idZona'] ?? 0);

    // Validaciones básicas
    $errores = [];
    
    if (empty($placa)) {
        $errores[] = "La placa es obligatoria";
    } elseif (strlen($placa) > 20) {
        $errores[] = "La placa no puede exceder los 20 caracteres";
    }

    if (empty($marca)) {
        $errores[] = "La marca es obligatoria";
    } elseif (strlen($marca) > 50) {
        $errores[] = "La marca no puede exceder los 50 caracteres";
    }

    if (strlen($modelo) > 50) {
        $errores[] = "El modelo no puede exceder los 50 caracteres";
    }

    if ($capacidadPeso <= 0) {
        $errores[] = "La capacidad de peso debe ser mayor que cero";
    }

    if ($capacidadVolumen <= 0) {
        $errores[] = "La capacidad de volumen debe ser mayor que cero";
    }

    if ($monto <= 0) {
        $errores[] = "El monto debe ser mayor que cero";
    }

    if ($idZona <= 0) {
        $errores[] = "Debe seleccionar una zona de cobertura válida";
    }

    if (!in_array($estado, ['Disponible', 'Ocupado'])) {
        $errores[] = "Estado no válido";
    }

    if (!empty($errores)) {
        throw new Exception(implode("\n", $errores));
    }

    // Verificar si la placa ya existe
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM vehiculos WHERE placa = :placa");
    $stmtCheck->bindParam(':placa', $placa);
    $stmtCheck->execute();
    
    if ($stmtCheck->fetchColumn() > 0) {
        throw new Exception("La placa ya está registrada en el sistema");
    }

    // Verificar que la zona exista
    $stmtZona = $conn->prepare("SELECT COUNT(*) FROM zonas_cobertura WHERE idZona = :idZona");
    $stmtZona->bindParam(':idZona', $idZona);
    $stmtZona->execute();
    
    if ($stmtZona->fetchColumn() == 0) {
        throw new Exception("La zona seleccionada no existe");
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO vehiculos 
            (idZona, placa, marca, modelo, capacidadPeso, capacidadVolumen, monto, estado) 
            VALUES 
            (:idZona, :placa, :marca, :modelo, :capacidadPeso, :capacidadVolumen, :monto, :estado)";
    
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':idZona', $idZona, PDO::PARAM_INT);
    $stmt->bindParam(':placa', $placa);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':capacidadPeso', $capacidadPeso);
    $stmt->bindParam(':capacidadVolumen', $capacidadVolumen);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':estado', $estado);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del vehículo recién insertado
        $idVehiculo = $conn->lastInsertId();
        
        echo json_encode([
            'success' => true,
            'message' => 'Vehículo registrado correctamente',
            'data' => [
                'idVehiculo' => $idVehiculo,
                'placa' => $placa,
                'marca' => $marca,
                'modelo' => $modelo,
                'zona' => $idZona
            ]
        ]);
    } else {
        throw new Exception("Error al registrar el vehículo");
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage(),
        'error_code' => $e->getCode(),
        'error_info' => $e->errorInfo ?? null
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => 400
    ]);
}
?>