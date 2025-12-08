<?php
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $monto_total = $_POST['monto_total'];
    $monto_pagado = $_POST['monto_pagado'] ?? 0;
    $monto_final = $_POST['monto_final'] ?? $monto_total;
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado'];

    if ($tipo === 'Natural') {
        $idCliente = $_POST['idCliente'];
        $sql = "UPDATE cuentas_cobrar_clientes 
                SET idCliente = :idCliente, descripcion = :descripcion, monto_total = :monto_total, 
                    monto_pagado = :monto_pagado, monto_final = :monto_final, 
                    fecha_emision = :fecha_emision, fecha_vencimiento = :fecha_vencimiento, 
                    estado = :estado
                WHERE idcobro = :id";
    } else {
        $idEmpresa = $_POST['idEmpresa'];
        $sql = "UPDATE cuentas_cobrar_empresas 
                SET idEmpresa = :idEmpresa, descripcion = :descripcion, monto_total = :monto_total, 
                    monto_pagado = :monto_pagado, monto_final = :monto_final, 
                    fecha_emision = :fecha_emision, fecha_vencimiento = :fecha_vencimiento, 
                    estado = :estado
                WHERE idcobroempresa = :id";
    }

    $stmt = $conn->prepare($sql);
    
    if ($tipo === 'Natural') {
        $stmt->bindParam(':idCliente', $idCliente);
    } else {
        $stmt->bindParam(':idEmpresa', $idEmpresa);
    }
    
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':monto_total', $monto_total);
    $stmt->bindParam(':monto_pagado', $monto_pagado);
    $stmt->bindParam(':monto_final', $monto_final);
    $stmt->bindParam(':fecha_emision', $fecha_emision);
    $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Cuenta actualizada correctamente';
    } else {
        $response['message'] = 'Error al actualizar la cuenta';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>