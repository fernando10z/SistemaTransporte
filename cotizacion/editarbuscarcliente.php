<?php
require '../conexion/conexion.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

try {
    $sql = "SELECT 
                s.idSolicitud, 
                CONCAT(c.nombre, ' ', c.apellidopat, ' ', c.apellidoMat) AS nombreCliente,
                s.origen, 
                s.destino, 
                s.peso, 
                s.volumen
            FROM solicitudes_clientes s
            JOIN clientes_naturales c ON s.idCliente = c.idCliente
            WHERE s.estado = 'Pendiente'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (CONCAT(c.nombre, ' ', c.apellidopat, ' ', c.apellidoMat) LIKE :busqueda OR 
                      s.origen LIKE :busqueda OR 
                      s.destino LIKE :busqueda)";
        $paramBusqueda = "%$busqueda%";
    }
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($busqueda)) {
        $stmt->bindParam(':busqueda', $paramBusqueda);
    }
    
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($resultados) > 0) {
        foreach ($resultados as $solicitud) {
            echo "<tr>
                    <td>{$solicitud['idSolicitud']}</td>
                    <td>".htmlspecialchars($solicitud['nombreCliente'])."</td>
                    <td>".htmlspecialchars($solicitud['origen'])."</td>
                    <td>".htmlspecialchars($solicitud['destino'])."</td>
                    <td>{$solicitud['peso']}</td>
                    <td>{$solicitud['volumen']}</td>
                    <td>
                        <button class='btn btn-sm btn-success' 
                                onclick='editSeleccionarSolicitudCliente(
                                    \"{$solicitud['idSolicitud']}\", 
                                    \"".htmlspecialchars($solicitud['nombreCliente'], ENT_QUOTES)."\", 
                                    \"".htmlspecialchars($solicitud['origen'], ENT_QUOTES)."\", 
                                    \"".htmlspecialchars($solicitud['destino'], ENT_QUOTES)."\", 
                                    \"{$solicitud['peso']}\", 
                                    \"{$solicitud['volumen']}\"
                                )'>
                            Seleccionar
                        </button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No se encontraron solicitudes pendientes</td></tr>";
    }
    
} catch(PDOException $e) {
    echo "<tr><td colspan='7' class='text-center text-danger'>Error al buscar solicitudes: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>