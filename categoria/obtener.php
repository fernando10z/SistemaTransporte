<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    $idCategoria = $_GET['idCategoria'];
    
    // Consulta SQL que une ambas tablas para obtener los datos del almacén
    $sql = "SELECT cp.*, a.nombre AS nombre_almacen 
            FROM categoria_producto cp
            INNER JOIN almacen a ON cp.idAlmacen = a.idAlmacen
            WHERE cp.idCategoria = :idCategoria";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idCategoria', $idCategoria);
    $stmt->execute();
    
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($categoria) {
        // Estructura de respuesta con todos los datos de categoría + nombre del almacén
        $response = [
            'success' => true,
            'data' => [
                'idCategoria' => $categoria['idCategoria'],
                'idAlmacen' => $categoria['idAlmacen'],
                'nombreCategoria' => $categoria['nombreCategoria'],
                'descripcion' => $categoria['descripcion'],
                'status' => $categoria['status'],
                'fecha_registro' => $categoria['fecha_registro'],
                'nombre_almacen' => $categoria['nombre_almacen'] // Nombre del almacén relacionado
            ]
        ];
        
        echo json_encode($response);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Categoría no encontrada'
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener la categoría: ' . $e->getMessage()
    ]);
}
?>