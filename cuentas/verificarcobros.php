<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

try {
    $hoy = date('Y-m-d');
    $diez_dias = date('Y-m-d', strtotime('+10 days'));
    $cinco_dias = date('Y-m-d', strtotime('+5 days'));
    
    // Consulta para clientes naturales
    $sql_clientes = "
    SELECT 
        cc.idcobro AS id,
        'Cliente' AS tipo_entidad,
        CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS nombre_cliente,
        cc.descripcion,
        cc.monto_total,
        cc.monto_pagado,
        cc.monto_final,
        cc.fecha_emision,
        cc.fecha_vencimiento,
        cc.estado,
        DATEDIFF(cc.fecha_vencimiento, '$hoy') AS dias_restantes
    FROM cuentas_cobrar_clientes cc
    JOIN clientes_naturales cn ON cc.idCliente = cn.idCliente
    WHERE cc.estado IN ('Pendiente', 'Parcial')
    AND cc.fecha_vencimiento BETWEEN '$hoy' AND '$diez_dias'
    ORDER BY cc.fecha_vencimiento ASC, cc.estado DESC";
    
    // Consulta para empresas
    $sql_empresas = "
    SELECT 
        ce.idcobroempresa AS id,
        'Empresa' AS tipo_entidad,
        cee.razonSocial AS nombre_cliente,
        ce.descripcion,
        ce.monto_total,
        ce.monto_pagado,
        ce.monto_final,
        ce.fecha_emision,
        ce.fecha_vencimiento,
        ce.estado,
        DATEDIFF(ce.fecha_vencimiento, '$hoy') AS dias_restantes
    FROM cuentas_cobrar_empresas ce
    JOIN clientes_empresas cee ON ce.idEmpresa = cee.idEmpresa
    WHERE ce.estado IN ('Pendiente', 'Parcial')
    AND ce.fecha_vencimiento BETWEEN '$hoy' AND '$diez_dias'
    ORDER BY ce.fecha_vencimiento ASC, ce.estado DESC";

    // Ejecutar consultas
    $stmt_clientes = $conn->prepare($sql_clientes);
    $stmt_clientes->execute();
    $cobros_clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt_empresas = $conn->prepare($sql_empresas);
    $stmt_empresas->execute();
    $cobros_empresas = $stmt_empresas->fetchAll(PDO::FETCH_ASSOC);

    // Clasificar por días restantes
    function clasificarCobros($cobros) {
        $hoy_array = [];
        $alerta_5dias = [];
        $alerta_10dias = [];
        
        foreach ($cobros as $cobro) {
            $dias = $cobro['dias_restantes'];
            
            if ($dias <= 0) {
                $hoy_array[] = $cobro;
            } elseif ($dias <= 5) {
                $alerta_5dias[] = $cobro;
            } else {
                $alerta_10dias[] = $cobro;
            }
        }
        
        return [
            'hoy' => $hoy_array,
            'alerta_5dias' => $alerta_5dias,
            'alerta_10dias' => $alerta_10dias
        ];
    }

    echo json_encode([
        'success' => true,
        'clientes' => clasificarCobros($cobros_clientes),
        'empresas' => clasificarCobros($cobros_empresas),
        'timestamp' => date('Y-m-d H:i:s')
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}
?>