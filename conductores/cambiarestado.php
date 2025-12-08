<?php
require '../conexion/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT estado FROM conductores WHERE idConductor = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $nuevoEstado = $row['estado'] === 'Activo' ? 'Inactivo' : 'Activo';

        $update = $conn->prepare("UPDATE conductores SET estado = ? WHERE idConductor = ?");
        $update->execute([$nuevoEstado, $id]);

        echo "ok";
    }
}
?>
