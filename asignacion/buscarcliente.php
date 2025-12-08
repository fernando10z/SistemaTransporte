<?php
require '../conexion/conexion.php';

$query = "SELECT c.idCotizacion, 
                 CONCAT(cl.nombre, ' ', cl.apellidopat, ' ', cl.apellidoMat) AS nombreCliente,
                 v.placa, v.modelo, c.peso, c.volumen, c.montoFinal, c.estado
          FROM cotizaciones_clientes c
          JOIN solicitudes_clientes s ON c.idSolicitud = s.idSolicitud
          JOIN clientes_naturales cl ON s.idCliente = cl.idCliente
          JOIN vehiculos v ON c.idVehiculo = v.idVehiculo
          WHERE c.estado = 'Pendiente'";

$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($result);
?>