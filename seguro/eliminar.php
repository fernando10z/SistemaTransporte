<?php
require_once '../conexion/conexion.php';

if (!isset($_POST['id'])) { http_response_code(400); exit; }

$id = (int) $_POST['id'];

$stmt = $conn->prepare("DELETE FROM seguros_vehiculo WHERE idSeguro = :id");
$stmt->execute([':id' => $id]);

echo "Registro eliminado";
