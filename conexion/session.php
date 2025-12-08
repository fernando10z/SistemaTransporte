<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Verificar credenciales
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND contrasena = ? AND estado = 'Activo'");
    $stmt->execute([$correo, $contrasena]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        $_SESSION['usuario'] = $usuario['nombreCompleto'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['idRol'] = $usuario['idRol'];
        $_SESSION['idUsuario'] = $usuario['idUsuario'];
        
        header("Location: ../index.php");
        exit(); 
    } else {
        header("Location: ../login.php?error=Credenciales incorrectas o usuario inactivo");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>