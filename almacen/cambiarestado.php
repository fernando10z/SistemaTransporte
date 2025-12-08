<?php
require '../conexion/conexion.php';

if (!empty($_POST['idAlmacen'])) {
    $id = $_POST['idAlmacen'];

    // Obtener estado actual
    $sql = "SELECT estado FROM almacen WHERE idAlmacen = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $estado = $stmt->fetchColumn();

    $nuevoEstado = ($estado === 'Activo') ? 'Inactivo' : 'Activo';

    // Actualizar estado
    $sql = "UPDATE almacen SET estado = ? WHERE idAlmacen = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nuevoEstado, $id]);

    echo "Estado cambiado a $nuevoEstado";
} else {
    echo "ID no válido.";
}
?>
