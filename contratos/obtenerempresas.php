<?php
require '../conexion/conexion.php';

$response = ['success' => false, 'data' => []];

try {
    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
    
    $sql = "SELECT idEmpresa, razonSocial, ruc, telefono, correo, direccion 
            FROM clientes_empresas 
            WHERE status = 'Activo' 
            AND (razonSocial LIKE :filtro OR ruc LIKE :filtro)
            ORDER BY razonSocial";
    
    $stmt = $conn->prepare($sql);
    $filtroLike = "%$filtro%";
    $stmt->bindParam(':filtro', $filtroLike);
    $stmt->execute();
    
    $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($empresas) {
        $response['success'] = true;
        $response['data'] = $empresas;
    } else {
        $response['message'] = 'No se encontraron empresas activas';
    }
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>