<?php
require '../conexion/conexion.php'; // contiene la conexión $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idpago'];

    $stmt = $conn->prepare("DELETE FROM cuentas_pagar WHERE idpago = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true, 'message' => 'Pago eliminado correctamente']);
}
?>
