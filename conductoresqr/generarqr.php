<?php
include('../conexion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idcodigoQR'])) {
    $idcodigoQR = $_POST['idcodigoQR'];
    
    try {
        $stmt = $conn->prepare("SELECT 
                              qr.idConductor,
                              qr.token_qr, 
                              qr.fecha_generacion,
                              c.nombre, 
                              c.Apepat, 
                              c.Apemat,
                              td.tipoDocumento, 
                              c.numerodocumento,
                              c.tipolicencia, 
                              c.licencia,
                              c.telefono, 
                              c.Correo
                              FROM codigo_qr_conductores qr
                              JOIN conductores c ON qr.idConductor = c.idConductor
                              JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                              WHERE qr.idcodigoQR = ?");
        $stmt->execute([$idcodigoQR]);
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            
            $response = [
                'success' => true,
                'idConductor' => $row['idConductor'],
                'token' => $row['token_qr'],
                'fecha' => $row['fecha_generacion'],
                'nombre' => $row['nombre'].' '.$row['Apepat'].' '.$row['Apemat'],
                'documento' => $row['tipoDocumento'].' - '.$row['numerodocumento'],
                'licencia' => $row['tipolicencia'].' - '.$row['licencia'],
                'telefono' => $row['telefono'],
                'correo' => $row['Correo']
            ];
            
            echo json_encode($response);
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