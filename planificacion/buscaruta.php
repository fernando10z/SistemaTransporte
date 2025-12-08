<?php
require_once '../conexion/conexion.php';
header('Content-Type: application/json');

$busqueda = $_POST['busqueda'] ?? '';

try {
    $sql = "SELECT idRuta as id, 
                   origen, 
                   destino, 
                   distancia_km as distancia, 
                   tiempo_estimado as tiempo
            FROM rutas
            WHERE estado = 'Activado'
            AND (origen LIKE :busqueda OR 
                 destino LIKE :busqueda OR 
                 descripcion LIKE :busqueda)";
    
    $stmt = $conn->prepare($sql);
    $busquedaParam = "%$busqueda%";
    $stmt->bindParam(':busqueda', $busquedaParam);
    $stmt->execute();
    
    $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $rutas
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>