<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$busqueda = $_POST['busqueda'] ?? '';

try {
    $sql = "SELECT idConductor as id, 
                   nombre, 
                   CONCAT(Apepat, ' ', Apemat) as apellidos,
                   licencia,
                   telefono,
                   estado
            FROM conductores
            WHERE estado = 'Activo'
            AND (nombre LIKE :busqueda OR 
                 Apepat LIKE :busqueda OR 
                 Apemat LIKE :busqueda OR
                 licencia LIKE :busqueda)";
    
    $stmt = $conn->prepare($sql);
    $busquedaParam = "%$busqueda%";
    $stmt->bindParam(':busqueda', $busquedaParam);
    $stmt->execute();
    
    $conductores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $conductores
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>