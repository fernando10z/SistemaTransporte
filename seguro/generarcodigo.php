<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Consulta para obtener el último código registrado
    $sql = "SELECT codigo FROM seguros_vehiculo ORDER BY idSeguro DESC LIMIT 1";
    $stmt = $conn->query($sql);
    $ultimoCodigo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ultimoCodigo && !empty($ultimoCodigo['codigo'])) {
        // Extraer el número del último código (ej. SEG0001 -> 0001)
        $numero = (int) substr($ultimoCodigo['codigo'], 3);
        $nuevoNumero = $numero + 1;
    } else {
        // Si no hay registros, empezar desde 1
        $nuevoNumero = 1;
    }

    // Formatear el nuevo código con ceros a la izquierda
    $nuevoCodigo = 'SEG' . str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT);

    echo json_encode([
        'success' => true,
        'codigo' => $nuevoCodigo
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al generar el código: ' . $e->getMessage()
    ]);
}
?>