<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idConductor'])) {
    $idConductor = $_POST['idConductor'];
    $busqueda = $_POST['busqueda'] ?? '';
    $fechaFiltro = $_POST['fechaFiltro'] ?? '';
    
    try {
        // Obtener datos básicos del conductor
        $stmt = $conn->prepare("SELECT 
                                    c.nombre, 
                                    c.Apepat, 
                                    c.Apemat,
                                    c.numerodocumento as documento,
                                    c.tipolicencia as tipoLicencia,
                                    c.licencia,
                                    td.tipoDocumento as tipoDocumento
                                FROM conductores c
                                JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                                WHERE c.idConductor = ?");
        $stmt->execute([$idConductor]);
        $conductor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$conductor) {
            echo json_encode([
                'success' => false, 
                'error' => 'Conductor no encontrado con ID: ' . $idConductor
            ]);
            exit;
        }

        // Obtener historial de asistencia
        $sql = "SELECT 
                    a.*
                FROM asistencia_conductores a
                WHERE a.idConductor = ?";
        
        $params = [$idConductor];
        
        if (!empty($fechaFiltro)) {
            $sql .= " AND DATE(a.fecha_registro) = ?";
            array_push($params, $fechaFiltro);
        } elseif (!empty($busqueda)) {
            $sql .= " AND (a.dia LIKE ? OR a.observaciones LIKE ?)";
            $paramBusqueda = "%$busqueda%";
            array_push($params, $paramBusqueda, $paramBusqueda);
        }
        
        $sql .= " ORDER BY a.fecha_registro DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Preparar respuesta
        $response = [
            'success' => true,
            'nombreCompleto' => $conductor['nombre'] . ' ' . $conductor['Apepat'] . ' ' . $conductor['Apemat'],
            'tipoDocumento' => $conductor['tipoDocumento'],
            'documento' => $conductor['documento'],
            'tipoLicencia' => $conductor['tipoLicencia'],
            'licencia' => $conductor['licencia'],
            'historial' => $historial
        ];
        
        echo json_encode($response);
   } catch (PDOException $e) {
        echo json_encode([
            'success' => false, 
            'error' => 'Error de base de datos: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'error' => 'ID de conductor no proporcionado'
    ]);
}
?>