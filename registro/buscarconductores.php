<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $sql = "SELECT idConductor, 
                  CONCAT(nombre, ' ', Apepat, ' ', Apemat) as nombre_completo, 
                  licencia, 
                  telefono,
                  estado
           FROM conductores 
           WHERE nombre LIKE :search 
              OR Apepat LIKE :search 
              OR Apemat LIKE :search 
              OR licencia LIKE :search
           LIMIT 10";
           
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $search . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    
    $conductores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($conductores);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la búsqueda: ' . $e->getMessage()]);
}
?>