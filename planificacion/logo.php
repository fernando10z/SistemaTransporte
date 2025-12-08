<?php
header('Content-Type: application/json');

require_once '../conexion/conexion.php'; // Usa tu archivo de conexión

$logo = 'default_logo.jpg';

try {
    $stmt = $conn->prepare("SELECT logo FROM configuracion_empresa LIMIT 1");
    $stmt->execute();
    $logoData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($logoData && !empty($logoData['logo'])) {
        $logo = $logoData['logo'];
    }
} catch (PDOException $e) {
    // Error opcionalmente logeado
}

echo json_encode([
    'logo_path' => '../configuracion/empresa/' . $logo
]);
