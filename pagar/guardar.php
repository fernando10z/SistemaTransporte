<?php
header('Content-Type: application/json');

require_once '../conexion/conexion.php';

$data = $_POST;

try {
    // Validar datos requeridos
    if (empty($data['idProveedor']) || empty($data['descripcion']) || empty($data['monto_total']) || 
        empty($data['fecha_emision']) || empty($data['fecha_vencimiento'])) {
        throw new Exception("Todos los campos son requeridos");
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO cuentas_pagar (idProveedor, descripcion, monto_total, monto_pagado, 
            fecha_emision, fecha_vencimiento, estado, monto_final) 
            VALUES (:idProveedor, :descripcion, :monto_total, :monto_pagado, 
            :fecha_emision, :fecha_vencimiento, :estado, :monto_final)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idProveedor', $data['idProveedor']);
    $stmt->bindParam(':descripcion', $data['descripcion']);
    $stmt->bindParam(':monto_total', $data['monto_total']);
    $stmt->bindParam(':monto_pagado', $data['monto_pagado']);
    $stmt->bindParam(':fecha_emision', $data['fecha_emision']);
    $stmt->bindParam(':fecha_vencimiento', $data['fecha_vencimiento']);
    $stmt->bindParam(':estado', $data['estado']);
     $stmt->bindParam(':monto_final', $data['monto_final']);

    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Cuenta por pagar registrada correctamente'
        ]);
    } else {
        throw new Exception("Error al guardar la cuenta por pagar");
    }
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>