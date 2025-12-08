<?php
include '../conexion/conexion.php';

$idProducto = $_GET['idProducto'];

try {
    $stmt = $conn->prepare("SELECT * FROM producto WHERE idProducto = ?");
    $stmt->execute([$idProducto]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        $response = [
            'success' => true,
            'data' => $producto
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Producto no encontrado'
        ];
    }
} catch(PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Error al obtener el producto: ' . $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>