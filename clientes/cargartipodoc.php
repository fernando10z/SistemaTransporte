<?php
require_once '../conexion/conexion.php';

$html = '';
try {
    $sql = "SELECT idTipoDocumento, tipodocumento FROM tipodocumento"; // Asume que tienes una tabla generos
    $stmt = $conn->query($sql);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<option value="'.$row['idTipoDocumento'].'">'.$row['tipodocumento'].'</option>';
    }
} catch (PDOException $e) {
    // En caso de error, devolver opción vacía
}

echo $html;
?>