<?php
require '../conexion/conexion.php';

if (isset($_POST['idCurso'])) {
    $id = $_POST['idCurso'];

    // Obtener estado actual
    $stmt = $conn->prepare("SELECT estado FROM cursos_conductor WHERE idCurso = ?");
    $stmt->execute([$id]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    $nuevoEstado = ($curso['estado'] === 'Activado') ? 'Desactivado' : 'Activado';

    // Actualizar estado
    $stmt = $conn->prepare("UPDATE cursos_conductor SET estado = ? WHERE idCurso = ?");
    $stmt->execute([$nuevoEstado, $id]);

    echo "Estado cambiado a: $nuevoEstado";
}
?>
