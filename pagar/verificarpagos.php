<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

try {
    $hoy = date('Y-m-d');
    $diez_dias = date('Y-m-d', strtotime('+10 days'));
    $cinco_dias = date('Y-m-d', strtotime('+5 days'));
    
    $sql = "
    SELECT 
        cp.idpago,
        p.nombre_empresa AS proveedor,
        p.numero_ruc,
        cp.descripcion,
        cp.monto_total,
        cp.monto_pagado,
        cp.monto_final,
        cp.fecha_emision,
        cp.fecha_vencimiento,
        cp.estado,
        DATEDIFF(cp.fecha_vencimiento, '$hoy') AS dias_restantes
    FROM cuentas_pagar cp
    JOIN proveedores p ON cp.idProveedor = p.idProveedor
    WHERE cp.estado IN ('Pendiente', 'Parcial')
    AND cp.fecha_vencimiento BETWEEN '$hoy' AND '$diez_dias'
    ORDER BY cp.fecha_vencimiento ASC, cp.estado DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Clasificar por días restantes
    $alerta_hoy = [];
    $alerta_5dias = [];
    $alerta_10dias = [];
    
    foreach ($pagos as $pago) {
        $dias = $pago['dias_restantes'];
        
        if ($dias <= 0) {
            $alerta_hoy[] = $pago;
        } elseif ($dias <= 5) {
            $alerta_5dias[] = $pago;
        } else {
            $alerta_10dias[] = $pago;
        }
    }

    echo json_encode([
        'success' => true,
        'alerta_hoy' => $alerta_hoy,
        'alerta_5dias' => $alerta_5dias,
        'alerta_10dias' => $alerta_10dias,
        'timestamp' => date('Y-m-d H:i:s')
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}
?>