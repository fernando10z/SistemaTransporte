<?php
include '../conexion/conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true) ?? $_POST;

try {

    $stmt = $conn->prepare("UPDATE producto SET 
        codigoProducto = ?, 
        nombreProducto = ?, 
        descripcion = ?, 
        idAlmacen = ?, 
        idCategoria = ?, 
        idsubcategoria = ?, 
        stock = ?, 
        stock_minimo = ?, 
        status = ?
    WHERE idProducto = ?");

    $stmt->execute([
        $data['codigoProducto'],
        $data['nombreProducto'],
        $data['descripcion'],
        $data['idAlmacen'],
        $data['idCategoria'],
        $data['idsubcategoria'],
        $data['stock'],
        $data['stock_minimo'],
        $data['status'],
        $data['idProducto']
    ]);

    $response = [
        'success' => true,
        'message' => 'Producto actualizado correctamente'
    ];
} catch(PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Error al actualizar el producto: ' . $e->getMessage()
    ];
}

echo json_encode($response);
?>
