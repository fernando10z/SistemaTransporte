<?php
require_once '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM terminos_condiciones WHERE id_terminos = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$id])) {
        echo json_encode(['success' => true, 'message' => 'Término eliminado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el término.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
