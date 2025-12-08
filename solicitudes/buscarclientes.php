<?php
include '../conexion/conexion.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

try {
    $sql = "SELECT idCliente, nombre, apellidopat, apellidoMat, numerodocumento, telefono, correo 
            FROM clientes_naturales 
            WHERE status = 'Activo'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (nombre LIKE :busqueda OR 
                      apellidopat LIKE :busqueda OR 
                      apellidoMat LIKE :busqueda OR 
                      numerodocumento LIKE :busqueda)";
    }
    
    $sql .= " ORDER BY nombre, apellidopat LIMIT 50";
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($busqueda)) {
        $paramBusqueda = "%$busqueda%";
        $stmt->bindParam(':busqueda', $paramBusqueda);
    }
    
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($resultados) > 0) {
        foreach ($resultados as $cliente) {
            echo "<tr>
                    <td>{$cliente['idCliente']}</td>
                    <td>{$cliente['nombre']}</td>
                    <td>{$cliente['apellidopat']}</td>
                    <td>{$cliente['apellidoMat']}</td>
                    <td>{$cliente['numerodocumento']}</td>
                    <td>{$cliente['telefono']}</td>
                    <td>{$cliente['correo']}</td>
                    <td>
                        <button class='btn btn-sm btn-success' 
                                onclick='seleccionarClienteNatural({$cliente['idCliente']}, \"".htmlspecialchars($cliente['nombre'], ENT_QUOTES)."\", \"".htmlspecialchars($cliente['apellidopat'], ENT_QUOTES)."\", \"".htmlspecialchars($cliente['apellidoMat'], ENT_QUOTES)."\")'>
                            Seleccionar
                        </button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>No se encontraron clientes naturales</td></tr>";
    }
    
} catch(PDOException $e) {
    echo "<tr><td colspan='8' class='text-center text-danger'>Error al buscar clientes: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>