<?php
header('Content-Type: application/json');

require_once '../conexion/conexion.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit;
}

try {
    $sql = "SELECT cp.*, p.nombre_empresa 
            FROM cuentas_pagar cp
            JOIN proveedores p ON cp.idProveedor = p.idProveedor
            WHERE cp.idpago = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $pago = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($pago) {
        echo json_encode([
            'success' => true,
            'data' => $pago
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró el pago con el ID proporcionado'
        ]);
    }
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>