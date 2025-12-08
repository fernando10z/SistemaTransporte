<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['idMovimiento']) || empty($_GET['idMovimiento'])) {
        throw new Exception("ID de movimiento no proporcionado");
    }

    $idMovimiento = $_GET['idMovimiento'];

    // Consulta para obtener los datos del movimiento y la información relacionada del producto
    $sql = "SELECT mp.*, 
                   p.codigoProducto, p.nombreProducto, p.stock_minimo,
                   a.nombre AS nombreAlmacen,
                   cp.nombreCategoria,
                   s.nomArea
            FROM movimiento_producto mp
            JOIN producto p ON mp.idProducto = p.idProducto
            JOIN almacen a ON p.idAlmacen = a.idAlmacen
            JOIN categoria_producto cp ON p.idCategoria = cp.idCategoria AND p.idAlmacen = cp.idAlmacen
            JOIN subcategoria s ON p.idsubcategoria = s.idsubcategoria AND p.idAlmacen = s.idAlmacen AND p.idCategoria = s.idCategoria
            WHERE mp.idMovimiento = :idMovimiento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idMovimiento', $idMovimiento, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'data' => $movimiento
        ]);
    } else {
        throw new Exception("No se encontró el movimiento con ID: $idMovimiento");
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>