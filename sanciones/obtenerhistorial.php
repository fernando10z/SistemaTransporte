<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if(isset($_POST['idSancion'])) {
    $idSancion = $_POST['idSancion'];
    
    try {
        // Obtener el idConductor asociado a esta sanción
        $sql = "SELECT s.idConductor, 
                       CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) AS nombre_completo,
                       CONCAT(td.tipoDocumento, ': ', c.numerodocumento) AS documento_completo,
                       CONCAT(c.tipolicencia, ' - ', c.licencia) AS licencia_completa
                FROM sanciones_conductores s
                INNER JOIN conductores c ON s.idConductor = c.idConductor
                INNER JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                WHERE s.idSancion = ?";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute([$idSancion]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($datos) {
            echo json_encode([
                'success' => true,
                'idConductor' => $datos['idConductor'],
                'datosConductor' => [
                    'nombre_completo' => $datos['nombre_completo'],
                    'documento_completo' => $datos['documento_completo'],
                    'licencia_completa' => $datos['licencia_completa']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Sancion no encontrada']);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de sanción no proporcionado']);
}
?>