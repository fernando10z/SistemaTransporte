<?php
// verificar_trabajo_dia.php
include('../conexion/conexion.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fecha'])) {
    try {
        $fecha = $_POST['fecha'];
        
        // Verificar si hay registros de asistencia para esa fecha
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM asistencia_conductores 
                               WHERE DATE(fecha_registro) = ?");
        $stmt->execute([$fecha]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'hubo_trabajo' => $resultado['total'] > 0
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'error' => 'Error de base de datos: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Fecha no proporcionada'
    ]);
}
?>