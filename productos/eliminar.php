<?php
include '../conexion/conexion.php'; // Conexión a base de datos

if (isset($_POST['idProducto'])) {
    $id = $_POST['idProducto'];

    $stmt = $conn->prepare("DELETE FROM producto WHERE idProducto = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "ok";
} else {
    echo "error";
}
