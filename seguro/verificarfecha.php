<?php
// Habilitar reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $hoy = new DateTime();
    $cincoDias = clone $hoy;
    $cincoDias->modify('+5 days');

    $conn->beginTransaction();

    // Actualizar seguros vencidos (solo Pendiente o Realizada)
    $sqlUpdate = "UPDATE seguros_vehiculo 
                  SET estado = 'Vencido' 
                  WHERE fecha_vencimiento < :hoy 
                  AND estado IN ('Pendiente', 'Realizada')";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([':hoy' => $hoy->format('Y-m-d')]);

    // Obtener seguros próximos a vencer
    $sqlVencimientos = "SELECT 
            v.placa AS vehiculo,
            v.modelo,
            s.nombre_seguro,
            s.fecha_vencimiento,
            DATEDIFF(s.fecha_vencimiento, CURDATE()) AS dias_restantes
        FROM seguros_vehiculo s
        JOIN vehiculos v ON v.idVehiculo = s.idVehiculo
        WHERE s.estado IN ('Pendiente', 'Realizada')
        AND s.fecha_vencimiento BETWEEN :hoy AND :cincoDias
        ORDER BY s.fecha_vencimiento ASC";

    $stmtVencimientos = $conn->prepare($sqlVencimientos);
    $stmtVencimientos->execute([
        ':hoy' => $hoy->format('Y-m-d'),
        ':cincoDias' => $cincoDias->format('Y-m-d')
    ]);

    $alertas = [
        'urgentes' => [],
        'avisos' => []
    ];

    while ($seguro = $stmtVencimientos->fetch(PDO::FETCH_ASSOC)) {
        $item = [
            'vehiculo' => $seguro['vehiculo'],
            'modelo' => $seguro['modelo'],
            'seguro' => $seguro['nombre_seguro'],
            'fecha' => $seguro['fecha_vencimiento'],
            'dias_restantes' => $seguro['dias_restantes']
        ];

        if ($seguro['dias_restantes'] <= 1) {
            $alertas['urgentes'][] = $item;
        } else {
            $alertas['avisos'][] = $item;
        }
    }

    $conn->commit();
    echo json_encode($alertas);

} catch (PDOException $e) {
    $conn->rollBack();
    http_response_code(500);
    echo json_encode([
        'error' => 'Error en la base de datos',
        'details' => $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error general',
        'details' => $e->getMessage()
    ]);
}
?>