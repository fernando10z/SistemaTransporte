<?php
header('Content-Type: application/json');

require_once '../conexion/conexion.php';

$data = $_POST;

try {
    // Validar datos requeridos
    if (empty($data['idpago']) || empty($data['idProveedor']) || empty($data['descripcion']) || 
        empty($data['monto_total']) || empty($data['fecha_emision']) || empty($data['fecha_vencimiento'])) {
        throw new Exception("Todos los campos son requeridos");
    }

    // Calcular monto final
    $monto_final = $data['monto_total'] - $data['monto_pagado'];
    
    // Actualizar en la base de datos
    $sql = "UPDATE cuentas_pagar 
            SET idProveedor = :idProveedor,
                descripcion = :descripcion,
                monto_total = :monto_total,
                monto_pagado = :monto_pagado,
                monto_final = :monto_final,
                fecha_emision = :fecha_emision,
                fecha_vencimiento = :fecha_vencimiento,
                estado = :estado
            WHERE idpago = :idpago";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idProveedor', $data['idProveedor']);
    $stmt->bindParam(':descripcion', $data['descripcion']);
    $stmt->bindParam(':monto_total', $data['monto_total']);
    $stmt->bindParam(':monto_pagado', $data['monto_pagado']);
    $stmt->bindParam(':monto_final', $monto_final);
    $stmt->bindParam(':fecha_emision', $data['fecha_emision']);
    $stmt->bindParam(':fecha_vencimiento', $data['fecha_vencimiento']);
    $stmt->bindParam(':estado', $data['estado']);
    $stmt->bindParam(':idpago', $data['idpago']);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Cuenta por pagar actualizada correctamente'
        ]);
    } else {
        throw new Exception("Error al actualizar la cuenta por pagar");
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