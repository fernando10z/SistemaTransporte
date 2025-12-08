<?php
header('Content-Type: application/json');
require_once '../conexion/conexion.php';

try {
    // Consulta para productos con diferencia de 15 unidades o menos
    $sql = "SELECT 
                p.idProducto, 
                p.codigoProducto, 
                p.nombreProducto, 
                a.nombre, 
                p.stock, 
                p.stock_minimo,
                (p.stock - p.stock_minimo) as diferencia
            FROM producto p
            LEFT JOIN almacen a ON p.idAlmacen = a.idAlmacen
            WHERE p.status = 'Activo' 
            AND (p.stock - p.stock_minimo) <= 15
            ORDER BY diferencia ASC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'productos' => $productos,
        'timestamp' => date('Y-m-d H:i:s')
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}
?>