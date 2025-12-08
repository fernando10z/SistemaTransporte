<?php
// Incluir la conexión a la base de datos
require_once '../conexion/conexion.php'; // Asegúrate de que este archivo contiene tu código de conexión PDO

header('Content-Type: application/json');

try {
    // Obtener los datos del POST
    $idAlmacen = isset($_POST['idAlmacen']) ? $_POST['idAlmacen'] : null;
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $estado = $_POST['estado'];
    
    if (empty($idAlmacen)) {
        // Insertar nuevo almacén
        $stmt = $conn->prepare("INSERT INTO almacen (nombre, ubicacion, estado) VALUES (:nombre, :ubicacion, :estado)");
    } else {
        // Actualizar almacén existente
        $stmt = $conn->prepare("UPDATE almacen SET nombre = :nombre, ubicacion = :ubicacion, estado = :estado WHERE idAlmacen = :idAlmacen");
        $stmt->bindParam(':idAlmacen', $idAlmacen);
    }
    
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':ubicacion', $ubicacion);
    $stmt->bindParam(':estado', $estado);
    
    $stmt->execute();
    
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>