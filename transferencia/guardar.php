<?php
require_once '../conexion/conexion.php';

// Obtener los datos del formulario
$idtransaccion = isset($_POST['idtransaccion']) ? $_POST['idtransaccion'] : null;
$idServicio = isset($_POST['idServicio']) && !empty($_POST['idServicio']) ? $_POST['idServicio'] : null;
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$concepto = $_POST['concepto'];
$monto = $_POST['monto'];
$fecha = $_POST['fecha'];
$metodo_pago = $_POST['metodo_pago'];
$observaciones = $_POST['observaciones'] ?? null;

try {
    // Preparar la consulta SQL
    if ($idtransaccion) {
        // Actualizar transacción existente
        $sql = "UPDATE transacciones_financieras SET 
                idServicio = :idServicio,
                tipo = :tipo,
                estado = :estado,
                concepto = :concepto,
                monto = :monto,
                fecha = :fecha,
                metodo_pago = :metodo_pago,
                observaciones = :observaciones
                WHERE idtransaccion = :idtransaccion";
    } else {
        // Insertar nueva transacción
        $sql = "INSERT INTO transacciones_financieras 
                (idServicio, tipo, estado, concepto, monto, fecha, metodo_pago, observaciones)
                VALUES 
                (:idServicio, :tipo, :estado, :concepto, :monto, :fecha, :metodo_pago, :observaciones)";
    }

    $stmt = $conn->prepare($sql);

    // Bind parameters
    if ($idtransaccion) {
        $stmt->bindParam(':idtransaccion', $idtransaccion);
    }
    $stmt->bindParam(':idServicio', $idServicio);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':concepto', $concepto);
    $stmt->bindParam(':monto', $monto);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':metodo_pago', $metodo_pago);
    $stmt->bindParam(':observaciones', $observaciones);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el ID de la transacción insertada (si es nueva)
    if (!$idtransaccion) {
        $idtransaccion = $conn->lastInsertId();
    }

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Transacción guardada correctamente',
        'idtransaccion' => $idtransaccion
    ]);

} catch (PDOException $e) {
    // Manejar errores
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar la transacción: ' . $e->getMessage()
    ]);
}
?>