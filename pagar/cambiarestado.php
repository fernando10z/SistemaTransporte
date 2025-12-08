<?php
require '../conexion/conexion.php'; // contiene la conexión $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idpago'];

    $sql = "SELECT estado FROM cuentas_pagar WHERE idpago = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $estadoActual = $stmt->fetchColumn();

    if ($estadoActual === false) {
        echo json_encode(['success' => false, 'message' => 'Pago no encontrado']);
        exit;
    }

    $nuevoEstado = $estadoActual === 'Pendiente' ? 'Parcial' : ($estadoActual === 'Parcial' ? 'Pagado' : 'Pagado');

    $update = $conn->prepare("UPDATE cuentas_pagar SET estado = ? WHERE idpago = ?");
    $update->execute([$nuevoEstado, $id]);

    echo json_encode(['success' => true, 'message' => 'Estado actualizado a ' . $nuevoEstado]);
}
?>
