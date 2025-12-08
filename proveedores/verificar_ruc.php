<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['existe' => false];

try {
    // Validar datos de entrada
    if (!isset($_GET['idTipoRuc']) || !isset($_GET['numero_ruc'])) {
        throw new Exception("Datos incompletos para la verificación");
    }

    $idTipoRuc = intval($_GET['idTipoRuc']);
    $numero_ruc = trim($_GET['numero_ruc']);
    $idProveedor = isset($_GET['idProveedor']) ? intval($_GET['idProveedor']) : null;

    // Validar RUC (11 dígitos)
    if (!preg_match('/^\d{11}$/', $numero_ruc)) {
        throw new Exception("El RUC debe tener exactamente 11 dígitos");
    }

    // Consulta para verificar si el RUC ya existe
    $sql = "SELECT idProveedor FROM proveedores 
            WHERE idTipoRuc = :idTipoRuc 
            AND numero_ruc = :numero_ruc";
    
    if ($idProveedor) {
        $sql .= " AND idProveedor != :idProveedor";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idTipoRuc', $idTipoRuc, PDO::PARAM_INT);
    $stmt->bindParam(':numero_ruc', $numero_ruc, PDO::PARAM_STR);
    
    if ($idProveedor) {
        $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    }

    $stmt->execute();

    $response['existe'] = $stmt->rowCount() > 0;

} catch (Exception $e) {
    $response = [
        'error' => true,
        'message' => $e->getMessage()
    ];
} finally {
    if (isset($conn)) {
        $conn = null;
    }
    exit(json_encode($response));
}
?>