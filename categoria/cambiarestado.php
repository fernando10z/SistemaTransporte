<?php
require '../conexion/conexion.php';

if (isset($_POST['idCategoria'])) {
    $id = $_POST['idCategoria'];

    // Obtener estado actual
    $stmt = $conn->prepare("SELECT status FROM categoria_producto WHERE idCategoria = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categoria) {
        $nuevoEstado = ($categoria['status'] === '1') ? '2' : '1';

        $update = $conn->prepare("UPDATE categoria_producto SET status = :nuevoEstado WHERE idCategoria = :id");
        $update->bindParam(':nuevoEstado', $nuevoEstado);
        $update->bindParam(':id', $id);
        $update->execute();

        echo "Estado cambiado exitosamente.";
    } else {
        echo "Categoría no encontrada.";
    }
}
?>
