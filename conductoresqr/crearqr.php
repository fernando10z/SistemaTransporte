<?php
include('../conexion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idConductor = $_POST['idConductor'];
    
    try {
        // Verificar si ya existe un QR para este conductor
        $stmt = $conn->prepare("SELECT idcodigoQR FROM codigo_qr_conductores WHERE idConductor = ?");
        $stmt->execute([$idConductor]);
        
        if($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'error' => 'Este conductor ya tiene un código QR']);
            exit;
        }
        
        // Obtener información del conductor
        $stmt = $conn->prepare("SELECT c.nombre, c.Apepat, c.Apemat, td.tipoDocumento, c.numerodocumento, c.horastrabajo
                               FROM conductores c
                               JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                               WHERE c.idConductor = ?");
        $stmt->execute([$idConductor]);
        $conductor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$conductor) {
            echo json_encode(['success' => false, 'error' => 'Conductor no encontrado']);
            exit;
        }
        
        // Preparar datos para el QR
        $nombres = $conductor['nombre'];
        $apellidos = $conductor['Apepat'] . ' ' . $conductor['Apemat'];
        $documentos = $conductor['tipoDocumento'] . ': ' . $conductor['numerodocumento'];
        $horastrabajo = $conductor['horastrabajo'];
        $token = bin2hex(random_bytes(16));
        
        // Insertar en la base de datos
        $stmt = $conn->prepare("INSERT INTO codigo_qr_conductores 
                               (idConductor, token_qr, nombres, Apellidos, documentos, horastrabajos, fecha_generacion, estado) 
                               VALUES (?, ?, ?, ?, ?, ?, NOW(), 'Activo')");
        $stmt->execute([$idConductor, $token, $nombres, $apellidos, $documentos, $horastrabajo]);
        
        // Devolver respuesta estándar con todos los datos
        echo json_encode([
            'success' => true,
            'qrData' => [
                'idConductor' => $idConductor,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'documentos' => $documentos,
                'horas_trabajo' => $horastrabajo,
                'token' => $token,
                'fecha_generacion' => date('d/m/Y, h:i:s a'),
                'estado' => 'Activo'
            ],
            'idcodigoQR' => $conn->lastInsertId()
        ]);
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>