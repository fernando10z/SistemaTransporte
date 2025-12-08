<?php
require_once '../conexion/conexion.php'; // tu conexión existente

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);

    // Validación básica
    if (empty($titulo) || empty($contenido)) {
        echo json_encode(['success' => false, 'message' => 'Título y contenido son obligatorios.']);
        exit;
    }

    // Obtener el siguiente número de orden
    $sqlOrden = "SELECT IFNULL(MAX(orden), 0) + 1 AS nuevoOrden FROM terminos_condiciones";
    $stmtOrden = $conn->query($sqlOrden);
    $orden = $stmtOrden->fetchColumn();

    // Insertar datos
    $sql = "INSERT INTO terminos_condiciones (titulo, contenido, orden) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$titulo, $contenido, $orden])) {
        echo json_encode(['success' => true, 'message' => 'Término registrado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo registrar.']);
    }
}
?>
