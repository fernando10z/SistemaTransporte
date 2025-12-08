<?php
include '../conexion/conexion.php';

$id = $_POST['idEvento'];
$tipo = $_POST['tipo'];

if ($tipo === 'cliente') {
    $sql = "DELETE FROM eventos_ruta WHERE idEvento = :id";
} else {
    $sql = "DELETE FROM eventos_ruta_empresa WHERE idEvento = :id";
}

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

echo "Evento eliminado correctamente.";
