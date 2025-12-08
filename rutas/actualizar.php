<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    // Validar datos recibidos
    $requiredFields = ['idRuta', 'origen', 'destino', 'distancia_km', 'tiempo_estimado', 'idZonaHidden'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Obtener el estado
    $estado = isset($_POST['estado']) && $_POST['estado'] === 'Activado' ? 'Activado' : 'Desactivado';

    // Preparar la consulta SQL
    $sql = "UPDATE rutas SET 
            idZona = :idZona, 
            origen = :origen, 
            destino = :destino, 
            distancia_km = :distancia_km, 
            tiempo_estimado = :tiempo_estimado, 
            descripcion = :descripcion, 
            estado = :estado
            WHERE idRuta = :idRuta";
    
    $stmt = $conn->prepare($sql);
    
    // Asignar valores a los parámetros
    $stmt->bindParam(':idZona', $_POST['idZonaHidden']);
    $stmt->bindParam(':origen', $_POST['origen']);
    $stmt->bindParam(':destino', $_POST['destino']);
    $stmt->bindParam(':distancia_km', $_POST['distancia_km']);
    $stmt->bindParam(':tiempo_estimado', $_POST['tiempo_estimado']);
    $stmt->bindParam(':descripcion', $_POST['descripcion']);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':idRuta', $_POST['idRuta']);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Ruta actualizada correctamente'
        ]);
    } else {
        throw new Exception("Error al actualizar la ruta");
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