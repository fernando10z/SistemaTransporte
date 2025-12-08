<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

if (isset($_GET['id_configuracion'])) {
    $id_configuracion = $_GET['id_configuracion'];

    // Consultamos los datos de configuración
    $sql = "SELECT * FROM configuracion_empresa WHERE id_configuracion = :id_configuracion";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_configuracion', $id_configuracion, PDO::PARAM_INT);
    $stmt->execute();

    $config = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($config) {
        // Verificar si las imágenes existen
        if (!empty($config['firmas']) && !file_exists('empresa/' . $config['firmas'])) {
            $config['firmas'] = null;
        }
        if (!empty($config['logo']) && !file_exists('empresa/' . $config['logo'])) {
            $config['logo'] = null;
        }
        
        echo json_encode($config);
    } else {
        echo json_encode(['error' => 'No se encontraron datos']);
    }
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>