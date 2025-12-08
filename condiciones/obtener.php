<?php
require_once '../conexion/conexion.php';

if (isset($_POST['id_terminos'])) {
    $id = $_POST['id_terminos'];

    $sql = "SELECT * FROM terminos_condiciones WHERE id_terminos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontró el término.']);
    }
}
?>
