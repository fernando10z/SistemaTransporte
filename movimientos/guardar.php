<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

// Obtener datos de $_POST en lugar de php://input
$data = $_POST;

// Depuración - registrar lo que llega al servidor

// Validación EXTRA del lado del servidor
if (!isset($data['idProducto']) || empty($data['idProducto'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Error crítico: ID de producto no recibido. Datos recibidos: ' . print_r($data, true)
    ]);
    exit;
}

try {
    // 1. Verificar que el producto existe
    $stmt = $conn->prepare("SELECT idProducto, stock FROM producto WHERE idProducto = :idProducto");
    $stmt->execute([':idProducto' => $data['idProducto']]);
    
    if ($stmt->rowCount() === 0) {
        throw new PDOException("El producto seleccionado no existe en la base de datos");
    }

    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 2. Validación adicional para salidas
    if ($data['tipo'] === 'salida') {
        $stockFinal = $producto['stock'] - $data['cantidad'];
        if ($stockFinal < 0) {
            throw new PDOException("No hay suficiente stock para realizar la salida");
        }
    }

    // 3. Iniciar transacción
    $conn->beginTransaction();
    
    // 4. Insertar movimiento
    $stmt = $conn->prepare("INSERT INTO movimiento_producto 
                           (idProducto, tipo, stock_inicial, cantidad, precio_soles, stock_final, observacion, motivo, fecha_movimiento) 
                           VALUES 
                           (:idProducto, :tipo, :stock_inicial, :cantidad, :precio_soles, :stock_final, :observacion, :motivo, :fecha_movimiento)");
    
    $stmt->execute([
        ':idProducto' => $data['idProducto'],
        ':tipo' => $data['tipo'],
        ':stock_inicial' => $data['stock_inicial'],
        ':cantidad' => $data['cantidad'],
        ':precio_soles' => $data['precio_soles'],
        ':stock_final' => $data['stock_final'],
        ':observacion' => $data['observacion'],
        ':motivo' => $data['motivo'],
        ':fecha_movimiento' => $data['fecha_movimiento']
    ]);
    
    // 5. Actualizar stock del producto
    $stmt = $conn->prepare("UPDATE producto SET stock = :stock_final WHERE idProducto = :idProducto");
    $stmt->execute([
        ':stock_final' => $data['stock_final'],
        ':idProducto' => $data['idProducto']
    ]);
    
    // 6. Confirmar transacción
    $conn->commit();
    
    echo json_encode([
        'success' => true,
        'message' => 'Movimiento registrado correctamente',
        'id_movimiento' => $conn->lastInsertId() // Devuelve el ID del movimiento insertado
    ]);
    
} catch(PDOException $e) {
    // Revertir transacción en caso de error
    $conn->rollBack();
    
    // Registrar error en archivo de log
    file_put_contents('error_movimiento.log', date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . "\n", FILE_APPEND);
    
    echo json_encode([
        'success' => false,
        'message' => 'Error al registrar el movimiento: ' . $e->getMessage(),
        'error_details' => $e->getTraceAsString()
    ]);
}
?>