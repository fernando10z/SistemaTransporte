<?php
require_once '../conexion/conexion.php';

try {
    // Consulta para obtener el último código de producto
    $query = "SELECT MAX(CAST(SUBSTRING(codigoProducto, 3) AS UNSIGNED)) as ultimo_numero 
              FROM producto 
              WHERE codigoProducto LIKE 'PR%'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Si no hay registros, empezamos desde 0
    $ultimo_numero = $result['ultimo_numero'] ?? 0;
    
    // Incrementamos para el nuevo código
    $nuevo_numero = $ultimo_numero + 1;
    
    // Formatear el nuevo código con 4 dígitos
    $nuevo_codigo = 'PR' . str_pad($nuevo_numero, 4, '0', STR_PAD_LEFT);
    
    echo json_encode([
        'success' => true,
        'codigo' => $nuevo_codigo
    ]);
    
} catch(PDOException $e) {
    // En caso de error, devolver PR0001 como valor por defecto
    echo json_encode([
        'success' => false,
        'message' => 'Error al generar código: ' . $e->getMessage(),
        'codigo' => 'PR0001'
    ]);
}
?>