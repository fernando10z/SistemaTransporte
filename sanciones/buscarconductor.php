<?php
include('../conexion/conexion.php');

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

try {
    $sql = "SELECT c.idConductor, 
                   CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) AS nombre_completo,
                   CONCAT(c.tipolicencia, ' - ', c.licencia) AS licencia_completa,
                   CONCAT(t.tipoDocumento, ' - ', c.numerodocumento) AS documento_completo
            FROM conductores c
            INNER JOIN tipodocumento t ON c.idTipoDocumento = t.idTipoDocumento
            WHERE c.estado IN ('Activo', 'Inactivo')";

    if(!empty($busqueda)) {
        $sql .= " AND (c.nombre LIKE :busqueda OR 
                      c.Apepat LIKE :busqueda OR 
                      c.Apemat LIKE :busqueda OR 
                      c.numerodocumento LIKE :busqueda OR 
                      c.licencia LIKE :busqueda)";
    }

    $sql .= " ORDER BY c.nombre, c.Apepat, c.Apemat";

    $stmt = $conn->prepare($sql);
    
    if(!empty($busqueda)) {
        $paramBusqueda = "%$busqueda%";
        $stmt->bindParam(':busqueda', $paramBusqueda);
    }

    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($resultados) > 0) {
        foreach($resultados as $row) {
            echo "<tr>
                    <td>".htmlspecialchars($row['nombre_completo'])."</td>
                    <td>".htmlspecialchars($row['licencia_completa'])."</td>
                    <td>".htmlspecialchars($row['documento_completo'])."</td>
                    <td>
                        <button class='btn btn-sm btn-primary' 
                                onclick='seleccionarConductor(".$row['idConductor'].", \"".addslashes($row['nombre_completo'])."\")'>
                            Seleccionar
                        </button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No se encontraron conductores</td></tr>";
    }
} catch(PDOException $e) {
    echo "<tr><td colspan='4' class='text-center text-danger'>Error al buscar conductores</td></tr>";
}
?>