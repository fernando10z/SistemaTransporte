<?php
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    $tipoCliente = $_POST['tipoCliente'];
    $descripcion = $_POST['descripcion'];
    $monto_total = $_POST['monto_total'];
    $monto_pagado = $_POST['monto_pagado'] ?? 0;
    $monto_final = $_POST['monto_final'] ?? $monto_total;
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $estado = $_POST['estado'];

    if ($tipoCliente === 'natural') {
        $idCliente = $_POST['idCliente'];
        $sql = "INSERT INTO cuentas_cobrar_clientes (idCliente, descripcion, monto_total, monto_pagado, monto_final, fecha_emision, fecha_vencimiento, estado) 
                VALUES (:idCliente, :descripcion, :monto_total, :monto_pagado, :monto_final, :fecha_emision, :fecha_vencimiento, :estado)";
    } else {
        $idEmpresa = $_POST['idEmpresa'];
        $sql = "INSERT INTO cuentas_cobrar_empresas (idEmpresa, descripcion, monto_total, monto_pagado, monto_final, fecha_emision, fecha_vencimiento, estado) 
                VALUES (:idEmpresa, :descripcion, :monto_total, :monto_pagado, :monto_final, :fecha_emision, :fecha_vencimiento, :estado)";
    }

    $stmt = $conn->prepare($sql);
    
    if ($tipoCliente === 'natural') {
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

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Cuenta por cobrar registrada correctamente';
    } else {
        $response['message'] = 'Error al guardar la cuenta por cobrar';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>