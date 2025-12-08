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

// Cambiar estado entre Planificado y Cancelado
$consulta = $conn->prepare("SELECT estado FROM $tabla WHERE $campo = ?");
$consulta->execute([$id]);
$estado = $consulta->fetchColumn();

$nuevoEstado = ($estado == 'Planificado') ? 'Cancelado' : 'Planificado';

$actualizar = $conn->prepare("UPDATE $tabla SET estado = ? WHERE $campo = ?");
$actualizar->execute([$nuevoEstado, $id]);

echo "Estado cambiado a '$nuevoEstado'";
