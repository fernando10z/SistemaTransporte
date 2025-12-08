<?php
require '../conexion/conexion.php';

$query = "SELECT c.idCotizacionEmpresa, 
                 e.razonSocial, 
                 v.placa, v.modelo, c.peso, c.volumen, c.montoFinal, c.estado
          FROM cotizaciones_empresas c
          JOIN solicitud_empresa s ON c.idSolicitudempresa = s.idSolicitudempresa
          JOIN clientes_empresas e ON s.idEmpresa = e.idEmpresa
          JOIN vehiculos v ON c.idVehiculo = v.idVehiculo
          WHERE c.estado = 'Pendiente'";

$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($result);
?>