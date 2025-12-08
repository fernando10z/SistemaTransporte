<?php
include('../conexion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idcodigoQR'])) {
    $idcodigoQR = $_POST['idcodigoQR'];
    
    try {
        $stmt = $conn->prepare("SELECT 
                              qr.idcodigoQR,
                              qr.idConductor,
                              qr.token_qr,
                              qr.nombres,
                              qr.Apellidos,
                              qr.documentos,
                              qr.horastrabajos,
                              DATE_FORMAT(qr.fecha_generacion, '%d/%m/%Y, %h:%i:%s %p') as fecha_formateada,
                              qr.estado
                              FROM codigo_qr_conductores qr
                              WHERE qr.idcodigoQR = ?");
        $stmt->execute([$idcodigoQR]);
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            
            echo json_encode([
                'success' => true,
                'qrData' => [
                    'idcodigoQR' => $row['idcodigoQR'],
                    'idConductor' => $row['idConductor'],
                    'token_qr' => $row['token_qr'],
                    'nombres' => $row['nombres'],
                    'apellidos' => $row['Apellidos'],
                    'documentos' => $row['documentos'],
                    'horas_trabajo' => $row['horastrabajos'],
                    'fecha_generacion' => $row['fecha_formateada'],
                    'estado' => $row['estado']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se encontró el código QR']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Parámetros incorrectos']);
}
?>