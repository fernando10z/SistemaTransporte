<?php
require_once '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_terminos'];
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $orden = (int) $_POST['orden'];

    if (empty($titulo) || empty($contenido) || $orden < 1) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    $sql = "UPDATE terminos_condiciones SET titulo = ?, contenido = ?, orden = ? WHERE id_terminos = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$titulo, $contenido, $orden, $id])) {
        echo json_encode(['success' => true, 'message' => 'Término actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar.']);
    }
}
?>
