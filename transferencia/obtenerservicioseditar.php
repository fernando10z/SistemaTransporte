<?php
require_once '../conexion/conexion.php';

$busqueda = $_POST['busqueda'] ?? '';

$query = "SELECT idServicio, nombreServicio, tipoCarga, Estado 
          FROM servicios 
          WHERE (nombreServicio LIKE ? OR tipoCarga LIKE ?)
          AND Estado = 'Activo' 
          ORDER BY nombreServicio";

$paramBusqueda = "%$busqueda%";
$stmt = $conn->prepare($query);
$stmt->execute([$paramBusqueda, $paramBusqueda]);

$html = '';
while ($servicio = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<tr>
                <td>{$servicio['idServicio']}</td>
                <td>{$servicio['nombreServicio']}</td>
                <td>{$servicio['tipoCarga']}</td>
                <td>{$servicio['Estado']}</td>
                <td>
                    <button class='btn btn-sm btn-primary seleccionar-servicio' 
                            data-id='{$servicio['idServicio']}' 
                            data-nombre='{$servicio['nombreServicio']}'>
                        <i class='fas fa-check me-1'></i> Seleccionar
                    </button>
                </td>
              </tr>";
}

if (empty($html)) {
    $html = "<tr>
                <td colspan='5' class='text-center py-4'>
                    No se encontraron servicios
                </td>
            </tr>";
}

echo $html;
?>