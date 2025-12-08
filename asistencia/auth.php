<?php
session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$dbname = "transportes";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die(json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]));
}

$response = ['id_rol' => 0, 'error' => ''];

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    
    try {
        $stmt = $conn->prepare("SELECT idRol FROM usuarios WHERE idUsuario = :idUsuario");
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $response['id_rol'] = $row['idRol'];
        } else {
            $response['error'] = 'Usuario no encontrado';
        }
    } catch(PDOException $e) {
        $response['error'] = 'Error al consultar rol: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'Usuario no autenticado';
}

header('Content-Type: application/json');
echo json_encode($response);
?>