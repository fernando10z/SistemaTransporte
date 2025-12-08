<?php
require_once '../conexion/conexion.php';

if (isset($_POST['id'])) {
    $idRuta = $_POST['id'];

    // Obtener estado actual
    $stmt = $conn->prepare("SELECT estado FROM rutas WHERE idRuta = ?");
    $stmt->execute([$idRuta]);
    $ruta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ruta) {
        $nuevoEstado = ($ruta['estado'] === 'Activado') ? 'Desactivado' : 'Activado';

        $update = $conn->prepare("UPDATE rutas SET estado = ? WHERE idRuta = ?");
        $update->execute([$nuevoEstado, $idRuta]);

        echo json_encode(['success' => true, 'estado' => $nuevoEstado]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ruta no encontrada']);
    }
}
?>
