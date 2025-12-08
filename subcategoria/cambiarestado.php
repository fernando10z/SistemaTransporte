<?php
require_once '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT status FROM subcategoria WHERE idsubcategoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $estadoActual = $stmt->fetchColumn();

    $nuevoEstado = ($estadoActual === '1') ? '2' : '1';

    $update = "UPDATE subcategoria SET status = ? WHERE idsubcategoria = ?";
    $stmt = $conn->prepare($update);
    $stmt->execute([$nuevoEstado, $id]);

    echo "Estado actualizado correctamente";
}
?>
