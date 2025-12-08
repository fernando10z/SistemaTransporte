<?php
require '../conexion/conexion.php';

if (!empty($_POST['idAlmacen'])) {
    $id = $_POST['idAlmacen'];

    $sql = "DELETE FROM almacen WHERE idAlmacen = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    echo "Almacén eliminado correctamente.";
} else {
    echo "ID no válido.";
}
?>
