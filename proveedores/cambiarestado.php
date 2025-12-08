<?php
require '../conexion/conexion.php';

$id = $_GET['id'];
$estado = $_GET['estado'];

$sql = "UPDATE proveedores SET estado = :estado WHERE idProveedor = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['estado' => $estado, 'id' => $id]);

echo "Estado actualizado a $estado.";
?>
