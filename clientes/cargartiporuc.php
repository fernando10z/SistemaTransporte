<?php
require_once '../conexion/conexion.php';

$html = '';
try {
    $sql = "SELECT idTipoRuc, descripcion FROM tipo_ruc"; // Asume que tienes una tabla generos
    $stmt = $conn->query($sql);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<option value="'.$row['idTipoRuc'].'">'.$row['descripcion'].'</option>';
    }
} catch (PDOException $e) {
    // En caso de error, devolver opción vacía
}

echo $html;
?>