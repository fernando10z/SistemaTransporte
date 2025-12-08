<?php
include('../conexion/conexion.php');

$searchTerm = $_GET['search'] ?? '';

try {
    $stmt = $conn->prepare("SELECT 
                          c.idConductor,
                          CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) as nombreCompleto,
                          CONCAT(td.tipoDocumento, ' - ', c.numerodocumento) as documentoCompleto,
                          CONCAT(c.tipolicencia, ' - ', c.licencia) as licenciaCompleta,
                          c.horastrabajo,
                          c.estado
                          FROM conductores c
                          JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                          WHERE c.estado != 'Despedido' 
                          AND (c.nombre LIKE ? OR c.Apepat LIKE ? OR c.Apemat LIKE ? 
                               OR c.numerodocumento LIKE ? OR c.licencia LIKE ?)
                          ORDER BY c.Apepat, c.Apemat, c.nombre");
    
    $searchParam = "%$searchTerm%";
    $stmt->execute([$searchParam, $searchParam, $searchParam, $searchParam, $searchParam]);
    
    $conductores = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $conductores[] = $row;
    }
    
    header('Content-Type: application/json');
    echo json_encode($conductores);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>