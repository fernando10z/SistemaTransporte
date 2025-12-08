<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idtransaccion = $_POST['idtransaccion'] ?? null;
    
    if (!$idtransaccion) {
        echo json_encode(['success' => false, 'message' => 'ID de transacción no proporcionado']);
        exit;
    }
    
    // Recoger los datos del formulario
    $idServicio = !empty($_POST['idServicio']) ? $_POST['idServicio'] : null;
    $tipo = $_POST['tipo'] ?? '';
    $concepto = $_POST['concepto'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $fecha = $_POST['fecha'] ?? '';
    $metodo_pago = $_POST['metodo_pago'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $estado = $_POST['estado'] ?? 'Activo';
    
    try {
        // Actualizar la transacción
        $sql = "
            UPDATE transacciones_financieras 
            SET 
                idServicio = :idServicio,
                tipo = :tipo,
                concepto = :concepto,
                monto = :monto,
                fecha = :fecha,
                metodo_pago = :metodo_pago,
                observaciones = :observaciones,
                estado = :estado
            WHERE idtransaccion = :idtransaccion
        ";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idServicio', $idServicio, PDO::PARAM_INT);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':concepto', $concepto);
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':metodo_pago', $metodo_pago);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':idtransaccion', $idtransaccion, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Transacción actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la transacción']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>