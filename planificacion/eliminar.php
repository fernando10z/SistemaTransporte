<?php
require '../conexion/conexion.php';

$id = $_POST['id'];
$tipo = $_POST['tipo'];

if ($tipo == 'cliente') {
    $tabla = 'planificacion_ruta';
    $campo = 'idPlanificacion';
} elseif ($tipo == 'empresa') {
    $tabla = 'planificacion_ruta_empresa';
    $campo = 'idPlanificacionempresa';
} else {
    exit('Tipo inválido');
}

$eliminar = $conn->prepare("DELETE FROM $tabla WHERE $campo = ?");
$eliminar->execute([$id]);

echo "Planificación eliminada correctamente.";
