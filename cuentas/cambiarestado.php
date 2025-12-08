<?php
require '../conexion/conexion.php';

$id = $_POST['id'];
$tipo = $_POST['tipo'];
$estadoActual = $_POST['estado'];

$nuevoEstado = $estadoActual === 'Pendiente' ? 'Pagado' : ($estadoActual === 'Pagado' ? 'Parcial' : 'Pendiente');

if ($tipo === 'Natural') {
    $sql = "UPDATE cuentas_cobrar_clientes SET estado = ? WHERE idcobro = ?";
} else {
    $sql = "UPDATE cuentas_cobrar_empresas SET estado = ? WHERE idcobroempresa = ?";
}

$stmt = $conn->prepare($sql);
$stmt->execute([$nuevoEstado, $id]);

echo "Estado cambiado a: $nuevoEstado";
