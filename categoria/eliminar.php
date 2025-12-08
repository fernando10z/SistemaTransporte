<?php
require '../conexion/conexion.php';

if (isset($_POST['idCategoria'])) {
    $id = $_POST['idCategoria'];

    $sql = "DELETE FROM categoria_producto WHERE idCategoria = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Categoría eliminada correctamente.";
    } else {
        echo "Error al eliminar la categoría.";
    }
}
?>
