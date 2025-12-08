<?php
require '../conexion/conexion.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

try {
    $sql = "SELECT 
                s.idSolicitudempresa, 
                e.razonSocial,
                s.origen, 
                s.destino, 
                s.peso, 
                s.volumen
            FROM solicitud_empresa s
            JOIN clientes_empresas e ON s.idEmpresa = e.idEmpresa
            WHERE s.estado = 'pendiente'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (e.razonSocial LIKE :busqueda OR 
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
                    <td>{$solicitud['idSolicitudempresa']}</td>
                    <td>".htmlspecialchars($solicitud['razonSocial'])."</td>
                    <td>".htmlspecialchars($solicitud['origen'])."</td>
                    <td>".htmlspecialchars($solicitud['destino'])."</td>
                    <td>{$solicitud['peso']}</td>
                    <td>{$solicitud['volumen']}</td>
                    <td>
                        <button class='btn btn-sm btn-success' 
                                onclick='editSeleccionarSolicitudEmpresa(
                                    \"{$solicitud['idSolicitudempresa']}\", 
                                    \"".htmlspecialchars($solicitud['razonSocial'], ENT_QUOTES)."\", 
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