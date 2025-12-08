<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $requiredFields = ['origen', 'destino', 'distancia_km', 'tiempo_estimado', 'idZonaHidden'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Obtener el estado
    $estado = isset($_POST['estado']) && $_POST['estado'] === 'Activado' ? 'Activado' : 'Desactivado';

    // Preparar la consulta SQL
    $sql = "INSERT INTO rutas (idZona, origen, destino, distancia_km, tiempo_estimado, descripcion, estado) 
            VALUES (:idZona, :origen, :destino, :distancia_km, :tiempo_estimado, :descripcion, :estado)";
    
    $stmt = $conn->prepare($sql);
    
    // Asignar valores a los parámetros
    $stmt->bindParam(':idZona', $_POST['idZonaHidden']);
    $stmt->bindParam(':origen', $_POST['origen']);
    $stmt->bindParam(':destino', $_POST['destino']);
    $stmt->bindParam(':distancia_km', $_POST['distancia_km']);
    $stmt->bindParam(':tiempo_estimado', $_POST['tiempo_estimado']);
    $stmt->bindParam(':descripcion', $_POST['descripcion']);
    $stmt->bindParam(':estado', $estado);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Ruta registrada correctamente'
        ]);
    } else {
        throw new Exception("Error al registrar la ruta");
    }
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>