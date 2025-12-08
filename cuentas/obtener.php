<?php
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => '', 'data' => null];

try {
    $id = $_GET['id'];
    $tipo = $_GET['tipo'];

    if ($tipo === 'Natural') {
        $sql = "SELECT cc.*, CONCAT(cn.nombre, ' ', cn.apellidopat, ' ', cn.apellidoMat) AS nombre 
                FROM cuentas_cobrar_clientes cc
                JOIN clientes_naturales cn ON cc.idCliente = cn.idCliente
                WHERE cc.idcobro = :id";
    } else {
        $sql = "SELECT ce.*, cee.razonSocial AS nombre 
                FROM cuentas_cobrar_empresas ce
                JOIN clientes_empresas cee ON ce.idEmpresa = cee.idEmpresa
                WHERE ce.idcobroempresa = :id";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $cuenta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cuenta) {
        $response['success'] = true;
        $response['data'] = $cuenta;
    } else {
        $response['message'] = 'No se encontró la cuenta';
    }
} catch (PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>