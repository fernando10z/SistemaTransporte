<?php
require '../conexion/conexion.php';

if (isset($_POST['idCurso'])) {
    $id = $_POST['idCurso'];
    $stmt = $conn->prepare("DELETE FROM cursos_conductor WHERE idCurso = ?");
    $stmt->execute([$id]);
    echo "Curso eliminado correctamente.";
}
?>
