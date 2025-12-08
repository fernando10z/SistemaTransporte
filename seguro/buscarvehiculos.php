<?php
require '../conexion/conexion.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT idVehiculo, placa, marca, modelo FROM vehiculos 
            WHERE placa LIKE :search OR marca LIKE :search OR modelo LIKE :search 
            ORDER BY placa ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', '%' . $searchTerm . '%');
    $stmt->execute();
    $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($vehiculos) > 0) {
        foreach ($vehiculos as $vehiculo) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($vehiculo['placa']) . '</td>';
            echo '<td>' . htmlspecialchars($vehiculo['marca']) . '</td>';
            echo '<td>' . htmlspecialchars($vehiculo['modelo']) . '</td>';
            echo '<td><button type="button" class="seleccionar-vehiculo" 
                  data-id="' . $vehiculo['idVehiculo'] . '"
                  data-placa="' . htmlspecialchars($vehiculo['placa']) . '"
                  data-marca="' . htmlspecialchars($vehiculo['marca']) . '"
                  data-modelo="' . htmlspecialchars($vehiculo['modelo']) . '">
                  Seleccionar</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4" class="text-center">No se encontraron vehículos</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="4" class="text-center">Error al buscar vehículos</td></tr>';
}
?>