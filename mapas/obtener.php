<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');

$idRuta = $_GET['idRuta'];

try {
    $stmt = $conn->prepare("SELECT * FROM puntos_ruta WHERE idRuta = ? ORDER BY orden");
    $stmt->execute([$idRuta]);
    $puntos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($puntos);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>