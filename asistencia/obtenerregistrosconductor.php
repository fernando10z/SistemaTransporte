<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idConductor'])) {
    $busqueda = $_POST['busqueda'] ?? '';
    
    try {
        $sql = "SELECT * FROM asistencia_conductores WHERE idConductor = ?";
        $params = [$_POST['idConductor']];
        
        if (!empty($busqueda)) {
            $sql .= " AND (dia LIKE ? OR observaciones LIKE ? OR motivojustificacion LIKE ?)";
            $paramBusqueda = "%$busqueda%";
            array_push($params, $paramBusqueda, $paramBusqueda, $paramBusqueda);
        }
        
        $sql .= " ORDER BY fecha_registro ASC"; // Orden ascendente para determinar rango
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'registros' => $registros]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error de base de datos']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID de conductor no proporcionado']);
}
?>