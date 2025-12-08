<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idtransaccion = $_POST['idtransaccion'] ?? null;
    
    if (!$idtransaccion) {
        echo json_encode(['success' => false, 'message' => 'ID de transacción no proporcionado']);
        exit;
    }
    
    try {
        // Consulta para obtener los datos de la transacción
        $sql = "
            SELECT 
                tf.idtransaccion,
                tf.idServicio,
                tf.tipo,
                tf.concepto,
                tf.monto,
                tf.fecha,
                tf.metodo_pago,
                tf.observaciones,
                tf.estado,
                s.nombreServicio
            FROM transacciones_financieras tf
            LEFT JOIN servicios s ON tf.idServicio = s.idServicio
            WHERE tf.idtransaccion = :idtransaccion
        ";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idtransaccion', $idtransaccion, PDO::PARAM_INT);
        $stmt->execute();
        
        $transaccion = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($transaccion) {
            echo json_encode(['success' => true, 'data' => $transaccion]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Transacción no encontrada']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>