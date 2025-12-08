<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => []];

try {
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    
    $sql = "SELECT idCliente, nombre, apellidopat, apellidoMat, numerodocumento, telefono, correo, direccion 
            FROM clientes_naturales 
            WHERE status = 'Activo' 
            AND (nombre LIKE :filtro OR apellidopat LIKE :filtro OR apellidoMat LIKE :filtro OR numerodocumento LIKE :filtro)
            ORDER BY nombre, apellidopat";
    
    $stmt = $conn->prepare($sql);
    $filtroLike = "%$filtro%";
    $stmt->bindParam(':filtro', $filtroLike);
    $stmt->execute();
    
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($clientes) {
        $response['success'] = true;
        $response['data'] = $clientes;
    } else {
        $response['message'] = 'No se encontraron clientes naturales activos';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>