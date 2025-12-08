<?php
require_once '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $idRuta = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM rutas WHERE idRuta = ?");
    $stmt->execute([$idRuta]);

    echo json_encode(['success' => true]);
}
?>
