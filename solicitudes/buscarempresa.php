<?php
include '../conexion/conexion.php';

$busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

try {
    $sql = "SELECT idEmpresa, razonSocial, ruc, direccion, telefono, correo 
            FROM clientes_empresas 
            WHERE status = 'Activo'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (razonSocial LIKE :busqueda OR 
                      ruc LIKE :busqueda)";
    }
    
    $sql .= " ORDER BY razonSocial LIMIT 50";
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($busqueda)) {
        $paramBusqueda = "%$busqueda%";
        $stmt->bindParam(':busqueda', $paramBusqueda);
    }
    
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($resultados) > 0) {
        foreach ($resultados as $empresa) {
            echo "<tr>
                    <td>{$empresa['idEmpresa']}</td>
                    <td>{$empresa['razonSocial']}</td>
                    <td>{$empresa['ruc']}</td>
                    <td>".htmlspecialchars($empresa['direccion'])."</td>
                    <td>{$empresa['telefono']}</td>
                    <td>{$empresa['correo']}</td>
                    <td>
                        <button class='btn btn-sm btn-success' 
                                onclick='seleccionarClienteEmpresa({$empresa['idEmpresa']}, \"".htmlspecialchars($empresa['razonSocial'], ENT_QUOTES)."\", \"{$empresa['ruc']}\")'>
                            Seleccionar
                        </button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No se encontraron empresas</td></tr>";
    }
    
} catch(PDOException $e) {
    echo "<tr><td colspan='7' class='text-center text-danger'>Error al buscar empresas: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>