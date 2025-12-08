<?php
require '../conexion/conexion.php';

$id = $_POST['id'];
$tipo = $_POST['tipo'];

if ($tipo === 'Natural') {
    $sql = "DELETE FROM cuentas_cobrar_clientes WHERE idcobro = ?";
} else {
    $sql = "DELETE FROM cuentas_cobrar_empresas WHERE idcobroempresa = ?";
}

$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

echo "Cuenta eliminada correctamente.";
