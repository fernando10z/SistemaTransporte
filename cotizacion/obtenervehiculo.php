<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

try {
    $sql = "SELECT * FROM vehiculos WHERE estado = 'Disponible'";
    
    if (!empty($busqueda)) {
        $sql .= " AND (placa LIKE :busqueda OR marca LIKE :busqueda OR modelo LIKE :busqueda)";
        $params = ['busqueda' => "%$busqueda%"];
    } else {
        $params = [];
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    
    $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($vehiculos)) {
        echo json_encode(['error' => 'No se encontraron vehículos disponibles']);
        exit;
    }
    
    echo json_encode($vehiculos);
} catch(PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>