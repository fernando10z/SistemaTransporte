<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_rol = $_SESSION['idRol'] ?? null;
$userId = $_SESSION['idUsuario'] ?? 0;

if (!$id_rol) {
    header("Location: /login.php");
    exit();
}
?>
