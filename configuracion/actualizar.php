<?php
include '../conexion/conexion.php';

// Forzamos el tipo de contenido a JSON
header('Content-Type: application/json');

// Verificamos que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

try {
    // Validamos los datos recibidos
    $required_fields = ['id_configuracion', 'nombre_empresa', 'ruc', 'direccion', 'telefono', 'correo'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['error' => 'El campo ' . $field . ' es obligatorio']);
            exit;
        }
    }

    $id_configuracion = $_POST['id_configuracion'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $ruc = $_POST['ruc'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $firma_actual = $_POST['firma-actual'] ?? null;
    $logo_actual = $_POST['logo-actual'] ?? null;

    // Directorio donde se guardan los archivos
    $upload_dir = '../configuracion/empresa/';

    // Manejo de la firma
    $firma = $firma_actual;
    if (isset($_FILES['firmas']) && $_FILES['firmas']['error'] === UPLOAD_ERR_OK) {
        // Eliminar la firma anterior si existe
        if ($firma_actual && file_exists($upload_dir . $firma_actual)) {
            unlink($upload_dir . $firma_actual);
        }

        // Subir la nueva firma
        $extension = pathinfo($_FILES['firmas']['name'], PATHINFO_EXTENSION);
        $firma_nombre = 'firma_' . uniqid() . '.' . $extension;
        $destino = $upload_dir . $firma_nombre;
        
        // Validar tipo de archivo
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['firmas']['type'], $allowed_types)) {
            echo json_encode(['error' => 'Tipo de archivo no permitido para la firma']);
            exit;
        }
        
        // Validar tamaño (2MB máximo)
        if ($_FILES['firmas']['size'] > 2097152) {
            echo json_encode(['error' => 'El archivo de firma excede el tamaño máximo de 2MB']);
            exit;
        }
        
        if (move_uploaded_file($_FILES['firmas']['tmp_name'], $destino)) {
            $firma = $firma_nombre;
        }
    }

    // Manejo del logo
    $logo = $logo_actual;
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        // Eliminar el logo anterior si existe
        if ($logo_actual && file_exists($upload_dir . $logo_actual)) {
            unlink($upload_dir . $logo_actual);
        }

        // Subir el nuevo logo
        $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logo_nombre = 'logo_' . uniqid() . '.' . $extension;
        $destino = $upload_dir . $logo_nombre;
        
        // Validar tipo de archivo
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['logo']['type'], $allowed_types)) {
            echo json_encode(['error' => 'Tipo de archivo no permitido para el logo']);
            exit;
        }
        
        // Validar tamaño (2MB máximo)
        if ($_FILES['logo']['size'] > 2097152) {
            echo json_encode(['error' => 'El archivo de logo excede el tamaño máximo de 2MB']);
            exit;
        }
        
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $destino)) {
            $logo = $logo_nombre;
        }
    }

    // Actualización en la base de datos
    $sql = "UPDATE configuracion_empresa SET 
            nombre_empresa = :nombre_empresa,
            ruc = :ruc,
            direccion = :direccion,
            telefono = :telefono,
            correo = :correo,
            firmas = :firmas,
            logo = :logo
            WHERE id_configuracion = :id_configuracion";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_empresa', $nombre_empresa);
    $stmt->bindParam(':ruc', $ruc);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':firmas', $firma);
    $stmt->bindParam(':logo', $logo);
    $stmt->bindParam(':id_configuracion', $id_configuracion);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Configuración actualizada correctamente']);
    } else {
        echo json_encode(['error' => 'Error al ejecutar la consulta SQL']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?>