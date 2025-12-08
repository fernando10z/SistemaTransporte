<?php
header('Content-Type: application/json');
session_start();
require_once '../conexion/conexion.php';

$logo = 'default_logo.jpg';
$nombre = 'Usuario';

try {
    $stmt = $conn->prepare("SELECT logo FROM configuracion_empresa LIMIT 1");
    $stmt->execute();
    $logoData = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($logoData && !empty($logoData['logo'])) {
        $logo = $logoData['logo'];
    }

    // Si tienes la sesión activa con el id del usuario
    if (isset($_SESSION['idUsuario'])) {
        $stmtUser = $conn->prepare("SELECT nombreCompleto, apellidos FROM usuarios WHERE idUsuario = ?");
        $stmtUser->execute([$_SESSION['idUsuario']]);
        $userData = $stmtUser->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            $nombre = $userData['nombreCompleto'] . ' ' . $userData['apellidos'];
        }
    }
} catch (PDOException $e) {
    // log error si es necesario
}

echo json_encode([
    'logo_path' => '../configuracion/empresa/' . $logo,
    'nombre' => $nombre
]);
