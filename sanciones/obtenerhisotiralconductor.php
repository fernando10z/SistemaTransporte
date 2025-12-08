<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if(isset($_POST['idConductor'])) {
    $idConductor = $_POST['idConductor'];
    
    try {
        // Obtener todas las sanciones del conductor
        $sql = "SELECT 
                    idSancion, 
                    tipo_sancion, 
                    motivo, 
                    monto_multa, 
                    fecha_inicio_sancion, 
                    fecha_fin_sancion, 
                    supervisor, 
                    estado, 
                    DATE_FORMAT(fecha_registro, '%d/%m/%Y %H:%i') AS fecha_registro
                FROM sanciones_conductores
                WHERE idConductor = ?
                ORDER BY fecha_registro DESC";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute([$idConductor]);
        $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($historial);
    } catch(PDOException $e) {
        echo json_encode(['error' => 'Error al obtener historial']);
    }
} else {
    echo json_encode(['error' => 'ID de conductor no proporcionado']);
}
?>