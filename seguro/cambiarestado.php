<?php
require_once '../conexion/conexion.php';

if (!isset($_POST['id'])) { http_response_code(400); exit; }

$id = (int) $_POST['id'];

$sql = "UPDATE seguros_vehiculo
        SET estado = 'Anulada'
        WHERE idSeguro = :id
          AND estado NOT IN ('Anulada')";

$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

echo "Estado cambiado a Anulada";
