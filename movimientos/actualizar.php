<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $requiredFields = [
        'idMovimiento', 'idProducto', 'tipo', 'stock_inicial', 
        'cantidad', 'precio_soles', 'stock_final', 'motivo', 'fecha_movimiento'
    ];
    
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Obtener datos del POST
    $idMovimiento = $_POST['idMovimiento'];
    $idProducto = $_POST['idProducto'];
    $tipo = $_POST['tipo'];
    $stockInicial = $_POST['stock_inicial'];
    $cantidad = $_POST['cantidad'];
    $precioSoles = $_POST['precio_soles'];
    $stockFinal = $_POST['stock_final'];
    $motivo = $_POST['motivo'];
    $fechaMovimiento = $_POST['fecha_movimiento'];
    $observacion = isset($_POST['observacion']) ? $_POST['observacion'] : null;

    // Iniciar transacción
    $conn->beginTransaction();

    // Actualizar el movimiento
    $sqlUpdateMovimiento = "UPDATE movimiento_producto SET
                           tipo = :tipo,
                           stock_inicial = :stock_inicial,
                           cantidad = :cantidad,
                           precio_soles = :precio_soles,
                           stock_final = :stock_final,
                           observacion = :observacion,
                           motivo = :motivo,
                           fecha_movimiento = :fecha_movimiento
                           WHERE idMovimiento = :idMovimiento";

    $stmt = $conn->prepare($sqlUpdateMovimiento);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':stock_inicial', $stockInicial);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':precio_soles', $precioSoles);
    $stmt->bindParam(':stock_final', $stockFinal);
    $stmt->bindParam(':observacion', $observacion);
    $stmt->bindParam(':motivo', $motivo);
    $stmt->bindParam(':fecha_movimiento', $fechaMovimiento);
    $stmt->bindParam(':idMovimiento', $idMovimiento);
    $stmt->execute();

    // Actualizar el stock del producto si es necesario
    $sqlUpdateProducto = "UPDATE producto SET stock = :stock_final WHERE idProducto = :idProducto";
    $stmt = $conn->prepare($sqlUpdateProducto);
    $stmt->bindParam(':stock_final', $stockFinal);
    $stmt->bindParam(':idProducto', $idProducto);
    $stmt->execute();

    // Confirmar transacción
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Movimiento actualizado correctamente'
    ]);
} catch (Exception $e) {
    // Revertir transacción en caso de error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar el movimiento: ' . $e->getMessage()
    ]);
}
?>