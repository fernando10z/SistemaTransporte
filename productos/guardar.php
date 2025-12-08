<?php
require_once '../conexion/conexion.php';

// Recibir datos del formulario
$datos = $_POST;

try {
    // Insertar el nuevo producto
    $query = "INSERT INTO producto (
                codigoProducto, 
                nombreProducto, 
                descripcion, 
                idAlmacen, 
                idCategoria, 
                idsubcategoria, 
                stock, 
                stock_minimo, 
                status
              ) VALUES (
                :codigoProducto,
                :nombreProducto,
                :descripcion,
                :idAlmacen,
                :idCategoria,
                :idsubcategoria,
                :stock,
                :stock_minimo,
                'Activo'
              )";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':codigoProducto', $datos['codigoProducto']);
    $stmt->bindParam(':nombreProducto', $datos['nombreProducto']);
    $stmt->bindParam(':descripcion', $datos['descripcion']);
    $stmt->bindParam(':idAlmacen', $datos['idAlmacen'], PDO::PARAM_INT);
    $stmt->bindParam(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT);
    $stmt->bindParam(':idsubcategoria', $datos['idsubcategoria'], PDO::PARAM_INT);
    $stmt->bindParam(':stock', $datos['stock'], PDO::PARAM_INT);
    $stmt->bindParam(':stock_minimo', $datos['stock_minimo'], PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Producto guardado correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al guardar el producto'
        ]);
    }
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>