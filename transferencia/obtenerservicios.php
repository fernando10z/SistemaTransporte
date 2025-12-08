<?php
require_once '../conexion/conexion.php';

$query = "SELECT idServicio, nombreServicio, tipoCarga, Estado, fechaRegistro FROM servicios WHERE Estado = 'Activo'";
$stmt = $conn->prepare($query);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($servicios as $servicio) {
    echo "<tr>
            <td>{$servicio['idServicio']}</td>
            <td>{$servicio['nombreServicio']}</td>
            <td>{$servicio['tipoCarga']}</td>
            <td>{$servicio['Estado']}</td>
            <td>{$servicio['fechaRegistro']}</td>
            <td>
                <button class='btn btn-sm btn-primary' onclick='seleccionarServicio({$servicio['idServicio']}, \"{$servicio['nombreServicio']}\")'>
                    <i class='fas fa-check'></i> Seleccionar
                </button>
            </td>
          </tr>";
}
?>