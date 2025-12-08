<?php
require_once '../conexion/conexion.php';

$html = '';
try {
    $sql = "SELECT idTipoDireccion, tipoDireccion FROM tipodireccion"; // Asume que tienes una tabla generos
    $stmt = $conn->query($sql);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<option value="'.$row['idTipoDireccion'].'">'.$row['tipoDireccion'].'</option>';
    }
} catch (PDOException $e) {
    // En caso de error, devolver opción vacía
}

echo $html;
?>