<?php
session_start(); // Ubica la sesión actual
session_unset(); // Limpia todas las variables (idUsuario, nombre, etc.)
session_destroy(); // Elimina la sesión del servidor

// Redirige al login
header("Location: login.php");
exit();
?>