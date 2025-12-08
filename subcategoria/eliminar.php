<?php
require_once '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM subcategoria WHERE idsubcategoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    echo "Subcategoría eliminada correctamente";
}
?>
